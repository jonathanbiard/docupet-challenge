#!/bin/bash -eu

MYSQL_DATABASE="docupet"
MYSQL_USERNAME="docupet"
MYSQL_PASSWORD="docupet"
MYSQL_ROOT_PASSWORD="root"

function echo-title ()
{
    echo ""
    echo "----------------------------------------------------------------------"
    echo "$1"
    echo "----------------------------------------------------------------------"
    echo ""
}

function start-mysql ()
{
    /usr/bin/mysqld_safe > /dev/null 2>&1 &

    LOOP_LIMIT=10
    for (( i=1 ; ; i++ )); do
        if [ "${i}" -eq ${LOOP_LIMIT} ]; then
            echo "Time out. Error log is shown as below:"
            tail -n 100 /fd-logs/mysql/mysql-error.log
            exit 1
        fi

        echo "=> Waiting for confirmation of MySQL service startup, trying ${i}/${LOOP_LIMIT} ..."
        sleep 5

        if [ $# -gt 0 ] && [ "$1" == "with-password" ]; then
            mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" -e "status" > /dev/null 2>&1 && break
        else
            mysql -uroot -e "status" > /dev/null 2>&1 && break
        fi
    done
}

export DEBIAN_FRONTEND=noninteractive



echo-title "Installing Generic Packages"

apt-get update
apt-get install -y --no-install-recommends wget unzip curl openssl

cp -v /build/ssl/certs/ca-certificates.crt /etc/ssl/certs/ca-certificates.crt



echo-title "Installing Technology Stack Packages"

apt-get update
apt-get install -y --no-install-recommends \
  nginx \
  mysql-server \
  php \
  php-cli \
  php-fpm \
  php-mysql \
  php-curl \
  php-gd \
  php-intl \
  php-xml \
  php-zip

php /build/php/composer/composer-setup.php
mv composer.phar /usr/local/bin/composer



echo-title "Configuring PHP"

rm -vf /etc/php/8.1/apache2/php.ini
cp -v /build/php/8.1/apache2/php.ini /etc/php/8.1/apache2/php.ini

rm -vf /etc/php/8.1/fpm/php.ini
cp -v /build/php/8.1/fpm/php.ini /etc/php/8.1/fpm/php.ini



echo-title "Configuring Nginx"

rm -vf /etc/nginx/sites-available/default
rm -vf /etc/nginx/fastcgi_params

cp -v /build/nginx/sites-available/default /etc/nginx/sites-available/default
cp -v /build/nginx/fastcgi_params /etc/nginx/fastcgi_params

mkdir -p /etc/ssl/certs/
mkdir -p /etc/ssl/private/
cp -v /build/nginx/certs/localhost.crt /etc/ssl/certs/localhost.crt
cp -v /build/nginx/private/localhost.key /etc/ssl/private/localhost.key



echo-title "Configuring MySQL"

rm -vf /etc/mysql/mysql.conf.d/mysql.cnf
rm -vf /etc/mysql/mysql.conf.d/mysqld.cnf

cp -v /build/mysql/mysql.cnf /etc/mysql/mysql.conf.d/mysql.cnf
cp -v /build/mysql/mysqld.cnf /etc/mysql/mysql.conf.d/mysqld.cnf

# Start mysql in the background
start-mysql

# Setup access
mysqladmin -uroot password "${MYSQL_ROOT_PASSWORD}"

# Improve security of the installation
mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" mysql -e "DELETE FROM mysql.user WHERE User='';"
mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" mysql -e "DELETE FROM mysql.db WHERE Db='test' OR Db='test\_%';"

# Set new user privileges
mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" -e "CREATE USER '${MYSQL_USERNAME}'@'%' IDENTIFIED BY '${MYSQL_PASSWORD}';"
mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" -e "GRANT ALL PRIVILEGES ON ${MYSQL_DATABASE}.* TO '${MYSQL_USERNAME}'@'%';"

# Flush privileges
mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" -e "FLUSH PRIVILEGES;"

# Create database, if uninitialized
mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" -e "CREATE DATABASE IF NOT EXISTS ${MYSQL_DATABASE} DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;"

# Import database data
mysql -uroot -p"${MYSQL_ROOT_PASSWORD}" --default-character-set=utf8 "${MYSQL_DATABASE}" < "/build/db-schema/docupet.sql"

# Stop the background mysql process
mysqladmin -uroot -p"${MYSQL_ROOT_PASSWORD}" shutdown



echo-title "Performing Final Cleanup"

rm -rf /build
rm -rf /var/lib/apt/lists/*
#rm -rf /tmp/phpmyadmin.zip
echo
