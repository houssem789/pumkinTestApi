FROM alpine:3.8

RUN apk update && apk add \
  vim \
  curl \
  wget \
  git \
  zip \
  php \
  php-pdo \
  php-pdo_pgsql \
  php-curl \
  php-openssl \
  php-iconv \
  php-xml \
  php-simplexml \
  php-xmlwriter \
  php-fpm \
  php-ctype \
  php-gd \
  php-xsl \
  php-mysqlnd \
  php-cli \
  php-intl \
  php-bz2 \
  php-zip \
  php-mbstring \
  php-opcache \
  php-json \
  php-phar \
  php-tokenizer \
  php7-apcu \
  php7-redis \
  php7-xdebug


RUN set -x ; \
  addgroup -g 82 -S www-data ; \
  adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

RUN mkdir /run/php

ADD config/www.conf /etc/php7/php-fpm.d/www.conf
ADD config/php-fpm.conf /etc/php7/php-fpm.conf

RUN ln -snf /usr/share/zoneinfo/Europe/Lisbon /etc/localtime

# Add Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm7", "-F"]
