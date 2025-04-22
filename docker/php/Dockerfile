FROM php:8.3-fpm

ARG UID=1000
ARG GID=1000

RUN groupadd -g $GID user-account && \
    useradd -u $UID -g user-account -m user-account

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    git curl unzip zip vim libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# ↓最後に書かないとバグります..
USER user-account
