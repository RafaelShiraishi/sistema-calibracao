FROM mcr.microsoft.com/devcontainers/php:8.2

RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install mysqli pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*