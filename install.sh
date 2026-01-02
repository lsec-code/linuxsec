#!/bin/bash

# ==========================================
#  LinuxSec Tools - Auto Installer
#  Author: LinuxSec Team
#  Repo: https://github.com/lsec-code/linuxsec.git
# ==========================================

# Warna Terminal
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# Konfigurasi
APP_DIR="/var/www/linuxsec"
GIT_URL="https://github.com/lsec-code/linuxsec.git"
DB_NAME="linuxsec_db"
DB_USER="linuxsec_user"
DB_PASS=$(openssl rand -base64 12) # Generate random password
PORT=9999
PHP_VER="8.3"

# ASCII Art Tux
clear
echo -e "${CYAN}"
echo "       .---. "
echo "      /     \ "
echo "      \.@-@./ "
echo "      / \`-' \ "
echo "     //  _  \\ "
echo "    | \  _  / | "
echo "    \  \`._.'  / "
echo "     \       / "
echo "      \`\"---.\"\` "
echo -e "${NC}"
echo -e "${BLUE}=======================================${NC}"
echo -e "${BLUE}   L I N U X S E C   I N S T A L L E R ${NC}"
echo -e "${BLUE}=======================================${NC}"
echo ""

# Cek Root
if [[ $EUID -ne 0 ]]; then
   echo -e "${RED}[!] Harap jalankan script ini sebagai root (sudo).${NC}"
   exit 1
fi

echo -e "${YELLOW}[+] Memulai instalasi...${NC}"
sleep 2

# 1. Update System & Install Dependencies
echo -e "${YELLOW}[+] Mengupdate sistem & menginstall dependensi...${NC}"
apt-get update
apt-get install -y software-properties-common curl git unzip zip mariadb-server nginx

# Tambahkan PPA PHP jika belum ada
add-apt-repository ppa:ondrej/php -y
apt-get update

# Install PHP 8.3 & Ekstensi
echo -e "${YELLOW}[+] Menginstall PHP $PHP_VER dan ekstensi yang dibutuhkan...${NC}"
apt-get install -y php$PHP_VER php$PHP_VER-fpm php$PHP_VER-mysql php$PHP_VER-curl \
    php$PHP_VER-xml php$PHP_VER-mbstring php$PHP_VER-zip php$PHP_VER-bcmath \
    php$PHP_VER-intl php$PHP_VER-gd php$PHP_VER-cli

# Install Composer
if ! command -v composer &> /dev/null; then
    echo -e "${YELLOW}[+] Menginstall Composer...${NC}"
    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer
fi

# 2. Setup Database
echo -e "${YELLOW}[+] Mengkonfigurasi Database...${NC}"
systemctl start mariadb
systemctl enable mariadb

# Buat DB dan User secara otomatis
mysql -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME};"
mysql -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';"
mysql -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';"
mysql -e "FLUSH PRIVILEGES;"

echo -e "${GREEN}[OK] Database siap. User: ${DB_USER} | Pass: (Tersimpan di .env)${NC}"

# 3. Setup Aplikasi Laravel
echo -e "${YELLOW}[+] Mengambil source code dari Github...${NC}"

# Hapus folder lama jika ada (untuk reinstall)
if [ -d "$APP_DIR" ]; then
    echo -e "${RED}[!] Direktori aplikasi lama ditemukan. Menghapus...${NC}"
    rm -rf $APP_DIR
fi

# Clone Repo
git clone $GIT_URL $APP_DIR

cd $APP_DIR

# Setup .env
echo -e "${YELLOW}[+] Mengkonfigurasi Environment (.env)...${NC}"
cp .env.example .env

# Update .env dengan sed
sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DB_NAME}/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=${DB_USER}/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASS}/" .env
sed -i "s/APP_URL=.*/APP_URL=http:\/\/localhost:${PORT}/" .env

# Install Dependencies Laravel
echo -e "${YELLOW}[+] Menginstall dependensi Laravel (Composer)...${NC}"
composer install --no-dev --optimize-autoloader

# Generate Key & Migrate
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan optimize

# Permission
chown -R www-data:www-data $APP_DIR
chmod -R 775 $APP_DIR/storage $APP_DIR/bootstrap/cache

# 4. Setup Nginx
echo -e "${YELLOW}[+] Mengkonfigurasi Nginx di Port ${PORT}...${NC}"

# Buat Config Nginx
cat > /etc/nginx/sites-available/linuxsec.conf <<EOF
server {
    listen $PORT;
    server_name _;
    root $APP_DIR/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php$PHP_VER-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

# Enable Site
ln -sf /etc/nginx/sites-available/linuxsec.conf /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

# Test & Restart Nginx
nginx -t
systemctl restart nginx

# 5. Selesai
echo ""
echo -e "${BLUE}=======================================${NC}"
echo -e "${GREEN}   I N S T A L A S I   S E L E S A I ! ${NC}"
echo -e "${BLUE}=======================================${NC}"
echo ""
echo -e "Aplikasi berjalan di: ${CYAN}http://IP_SERVER_ANDA:${PORT}${NC}"
echo -e "Database            : ${CYAN}${DB_NAME}${NC}"
echo -e "DB User             : ${CYAN}${DB_USER}${NC}"
echo -e "DB Password         : ${CYAN}${DB_PASS}${NC}"
echo ""
echo -e "${YELLOW}Simpan password database ini jika diperlukan!${NC}"
echo -e "${YELLOW}Password ini juga sudah tersimpan otomatis di file .env${NC}"
echo ""
