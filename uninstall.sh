#!/bin/bash

# ==========================================
#  LinuxSec Tools - Uninstaller
#  Author: LinuxSec Team
# ==========================================

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

APP_DIR="/var/www/linuxsec"
DB_NAME="linuxsec_db"
DB_USER="linuxsec_user"
NGINX_CONF="/etc/nginx/sites-available/linuxsec.conf"
NGINX_LINK="/etc/nginx/sites-enabled/linuxsec.conf"

clear
echo -e "${RED}"
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
echo -e "${RED}=========================================${NC}"
echo -e "${RED}   L I N U X S E C   U N I N S T A L L   ${NC}"
echo -e "${RED}=========================================${NC}"
echo ""

# Cek Root
if [[ $EUID -ne 0 ]]; then
   echo -e "${RED}[!] Harap jalankan script ini sebagai root (sudo).${NC}"
   exit 1
fi

echo -e "${YELLOW}[WARNING] Script ini akan menghapus:${NC}"
echo -e "1. Direktori Aplikasi: $APP_DIR"
echo -e "2. Database: $DB_NAME"
echo -e "3. Konfigurasi Nginx"
echo ""
read -p "Apakah Anda yakin ingin melanjutkan? (y/n) " -n 1 -r
echo ""
if [[ ! $REPLY =~ ^[Yy]$ ]]; then
    echo "Dibatalkan."
    exit 1
fi

echo -e "\n${YELLOW}[+] Menghapus konfigurasi Nginx...${NC}"
rm -f $NGINX_LINK
rm -f $NGINX_CONF
systemctl reload nginx

echo -e "${YELLOW}[+] Menghapus Database & User...${NC}"
mysql -e "DROP DATABASE IF EXISTS ${DB_NAME};"
mysql -e "DROP USER IF EXISTS '${DB_USER}'@'localhost';"

echo -e "${YELLOW}[+] Menghapus file aplikasi...${NC}"
rm -rf $APP_DIR

echo ""
echo -e "${GREEN}[OK] Uninstallation Complete.${NC}"
