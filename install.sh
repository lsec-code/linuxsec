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

# Default Konfigurasi
APP_DIR="/var/www/linuxsec"
GIT_URL="https://github.com/lsec-code/linuxsec.git"
DB_NAME="linuxsec_db"
DB_USER="root"
DB_PASS=""
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

# ==========================================
#  Interactive Setup
# ==========================================

# 1. Domain Input
echo -e "${YELLOW}[?] Masukkan Domain Anda (Biarkan kosong untuk 'localhost'):${NC}"
read -p "> " DOMAIN_INPUT

if [[ -z "$DOMAIN_INPUT" ]]; then
    DOMAIN="localhost"
    PORT="9999"
    SERVER_NAME="_"
    IS_LOCALHOST=true
    echo -e "${GREEN}[OK] Menggunakan mode Localhost Port 9999${NC}"
else
    DOMAIN="$DOMAIN_INPUT"
    PORT="80"
    SERVER_NAME="$DOMAIN"
    IS_LOCALHOST=false
    echo -e "${GREEN}[OK] Menggunakan Domain: $DOMAIN${NC}"
fi

# 2. SSL Option (Only if not localhost)
INSTALL_SSL=false
if [ "$IS_LOCALHOST" = false ]; then
    echo -e "\n${YELLOW}[?] Apakah Anda ingin menginstall SSL (HTTPS) via Let's Encrypt? (y/n)${NC}"
    read -p "> " SSL_CHOICE
    if [[ "$SSL_CHOICE" =~ ^[Yy]$ ]]; then
        INSTALL_SSL=true
    fi
fi

echo -e "\n${YELLOW}[+] Memulai instalasi dalam 3 detik...${NC}"
sleep 3

# ==========================================
#  Installation Process
# ==========================================

# 1. Update System & Install Dependencies
echo -e "${YELLOW}[+] Mengupdate sistem & menginstall dependensi...${NC}"
apt-get update
# Add Certbot if SSL needed
if [ "$INSTALL_SSL" = true ]; then
    apt-get install -y software-properties-common curl git unzip zip mariadb-server nginx certbot python3-certbot-nginx
else
    apt-get install -y software-properties-common curl git unzip zip mariadb-server nginx
fi

# Tambahkan PPA PHP
add-apt-repository ppa:ondrej/php -y
apt-get update

# Install PHP 8.3 & Ekstensi
echo -e "${YELLOW}[+] Menginstall PHP $PHP_VER...${NC}"
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

mysql -e "CREATE DATABASE IF NOT EXISTS ${DB_NAME};"
# mysql -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';"
# mysql -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '${DB_USER}'@'localhost';"
# mysql -e "FLUSH PRIVILEGES;"

# 3. Setup Aplikasi Laravel
echo -e "${YELLOW}[+] Mengambil source code...${NC}"

if [ -d "$APP_DIR" ]; then
    rm -rf $APP_DIR
fi

git clone $GIT_URL $APP_DIR
cd $APP_DIR

echo -e "${YELLOW}[+] Konfigurasi Environment...${NC}"
cp .env.example .env

sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DB_NAME}/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=${DB_USER}/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASS}/" .env

if [ "$IS_LOCALHOST" = true ]; then
    sed -i "s/APP_URL=.*/APP_URL=http:\/\/localhost:${PORT}/" .env
else
    # Production Settings for Domain
    sed -i "s/APP_ENV=local/APP_ENV=production/" .env
    sed -i "s/APP_DEBUG=true/APP_DEBUG=false/" .env

    if [ "$INSTALL_SSL" = true ]; then
        sed -i "s/APP_URL=.*/APP_URL=https:\/\/${DOMAIN}/" .env
    else
        sed -i "s/APP_URL=.*/APP_URL=http:\/\/${DOMAIN}/" .env
    fi
fi

echo -e "${YELLOW}[+] Install Dependencies...${NC}"
composer install --no-dev --optimize-autoloader

php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan optimize

chown -R www-data:www-data $APP_DIR
chmod -R 775 $APP_DIR/storage $APP_DIR/bootstrap/cache

# 4. Setup Nginx
echo -e "${YELLOW}[+] Konfigurasi Nginx...${NC}"

# Logic Listen Port
LISTEN_DIRECTIVE="listen $PORT;"
if [ "$IS_LOCALHOST" = false ]; then
    LISTEN_DIRECTIVE="listen 80;"
fi

cat > /etc/nginx/sites-available/linuxsec.conf <<EOF
server {
    $LISTEN_DIRECTIVE
    server_name $SERVER_NAME;
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

ln -sf /etc/nginx/sites-available/linuxsec.conf /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

grep -q "client_max_body_size" /etc/nginx/nginx.conf || sed -i '/http {/a \    client_max_body_size 100M;' /etc/nginx/nginx.conf

nginx -t
systemctl restart nginx

# 5. SSL Installation
if [ "$INSTALL_SSL" = true ]; then
    echo -e "${YELLOW}[+] Menginstall SSL Certbot...${NC}"
    certbot --nginx -d $DOMAIN --non-interactive --agree-tos --register-unsafely-without-email --redirect
fi

# 6. Selesai
echo ""
echo -e "${BLUE}=======================================${NC}"
echo -e "${GREEN}   I N S T A L A S I   S E L E S A I ! ${NC}"
echo -e "${BLUE}=======================================${NC}"
echo ""
if [ "$IS_LOCALHOST" = true ]; then
    echo -e "Akses Web: ${CYAN}http://localhost:${PORT}${NC}"
else
    if [ "$INSTALL_SSL" = true ]; then
        echo -e "Akses Web: ${CYAN}https://${DOMAIN}${NC}"
    else
        echo -e "Akses Web: ${CYAN}http://${DOMAIN}${NC}"
    fi
fi
echo -e "Database : ${CYAN}${DB_NAME}${NC}"
echo -e "User DB  : ${CYAN}${DB_USER}${NC}"
echo -e "Pass DB  : ${CYAN}${DB_PASS}${NC}"
echo ""
