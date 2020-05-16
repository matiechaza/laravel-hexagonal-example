FROM php:7.4-fpm
LABEL maintainer="guillaumebriday@gmail.com"

# Installing dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    default-mysql-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libmagickwand-dev \
    libzip-dev \
    libonig-dev \
    locales \
    zip \
    unzip \
    jpegoptim optipng pngquant gifsicle \
    && pecl install imagick

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installing extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath opcache
RUN docker-php-ext-enable imagick

# Installing composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Setting locales
RUN echo fr_FR.UTF-8 UTF-8 > /etc/locale.gen && locale-gen

# Changing Workdir
WORKDIR /application

# Add user for laravel application
RUN groupadd -g 1000 matias
RUN useradd -u 1000 -ms /bin/bash -g matias matias

# Copy existing application directory contents
COPY . /application

# Copy existing application directory permissions
COPY --chown=matias:www-data . /application

# Change current user to www
USER matias
