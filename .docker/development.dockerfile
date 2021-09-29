FROM php:7.4-cli-alpine

WORKDIR /app

# COPY composer.json .
# ADD composer.json .
# ADD . .

ENV TZ=America/Manaus

RUN set -xe \
&& echo $TZ | tee /etc/timezone \
&& cp -rf /usr/share/zoneinfo/$TZ /etc/localtime \
&& apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
freetype-dev \
libjpeg-turbo-dev \
libpng-dev \
libzip-dev \
icu-dev \
postgresql-dev \
git \
openssl bash nodejs npm \
tzdata \
&& docker-php-source extract \
&& docker-php-ext-configure pgsql --with-pgsql=/usr/include/ \
&& docker-php-ext-configure pdo_pgsql --with-pdo-pgsql=/usr/include/ \
&& docker-php-ext-install -j"$(getconf _NPROCESSORS_ONLN)" bcmath exif intl gd pdo mysqli pdo_mysql pgsql pdo_pgsql \
&& docker-php-ext-enable bcmath exif intl gd pdo mysqli pdo_mysql pgsql pdo_pgsql \
&& docker-php-source delete \
&& curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
&& composer config --global http-basic.gitlab.com ___token___ UxTd434L7z5YyPyqmxYf
# \
# && composer install

VOLUME /app/database /app/storage/app/public /app/storage/logs /app/storage/framework/cache /app/storage/framework/sessions /app/storage/framework/views

EXPOSE 8081

# CMD php -welsS [::]:8081 -t public
CMD ./artisan serve --verbose --no-interaction --host=[::] --port=8081
