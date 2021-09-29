# FROM php:7.4-apache-buster
FROM php:7.4-apache

WORKDIR /var/www/html

# COPY composer.json .
# ADD composer.json .
# ADD . .

ENV TZ=America/Manaus

RUN set -xe \
&& echo $TZ | tee /etc/timezone \
&& cp -rf /usr/share/zoneinfo/$TZ /etc/localtime \
&& sed -i 's/\/var\/www\/html/\/var\/www\/html\/public/' /etc/apache2/sites-enabled/000-default.conf \
&& a2enmod rewrite headers && service apache2 restart \
&& chown -R www-data. /var/www \
&& apt-get update -y && apt-get upgrade -yq --no-install-recommends && apt-get install -y --no-install-recommends \
libfreetype6-dev \
libjpeg-dev \
libpng-dev \
libzip-dev \
libicu-dev \
libpq-dev \
git \
tzdata \
unzip \
&& docker-php-source extract \
&& docker-php-ext-configure intl \
&& docker-php-ext-configure gd --with-freetype --with-jpeg \
&& docker-php-ext-configure pgsql --with-pgsql=/usr/include/ \
&& docker-php-ext-configure pdo_pgsql --with-pdo-pgsql=/usr/include/ \
&& docker-php-ext-install -j$(nproc) bcmath exif intl gd pdo mysqli pdo_mysql pgsql pdo_pgsql \
&& docker-php-ext-enable bcmath exif intl gd pdo mysqli pdo_mysql pgsql pdo_pgsql \
&& docker-php-source delete \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer config --global http-basic.gitlab.com ___token___ UxTd434L7z5YyPyqmxYf
# \
# && composer install

VOLUME /var/www/html/database /var/www/html/storage/app/public /var/www/html/storage/logs /var/www/html/storage/framework/cache /var/www/html/storage/framework/sessions /var/www/html/storage/framework/views

EXPOSE 80
