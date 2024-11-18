# Use uma imagem oficial do PHP com Apache
FROM php:8.0-apache

# Instale dependências e extensões necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mysqli

# Copie os arquivos do seu projeto para o contêiner
COPY . /var/www/html/

# Ajuste as permissões, se necessário
RUN chown -R www-data:www-data /var/www/html/
