FROM php:7.4-apache

RUN echo 'Installing APT packages...'

RUN apt-get update && apt-get install -y \
  git \
  zip \
  curl \
  sudo \
  nano \
  unzip \
  libicu-dev \
  libbz2-dev \
  libpng-dev \
  libjpeg-dev \
  libmcrypt-dev \
  libonig-dev \
  libreadline-dev \
  libfreetype6-dev \
  libxml2-dev \
  libzip-dev \
  g++ \
  pkg-config \
  build-essential \
  libmemcached-dev \
  libmemcached-tools \
  memcached \
  libcurl4-openssl-dev \
  libssl-dev

RUN echo 'Setting up permissions...'
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN echo 'Installing PHP extensions...'
RUN docker-php-ext-install zip
RUN docker-php-ext-configure gd --with-freetype
RUN docker-php-ext-install gd
RUN docker-php-ext-enable zip
RUN docker-php-ext-enable gd