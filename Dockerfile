# Dockerfile
# FROM php:7.2.34-apache
FROM php:8.1-apache

# Instala extensões PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia configuração do Apache
COPY session-config.ini /usr/local/etc/php/conf.d/session-config.ini

# Copia configuração do Apache
COPY ./configs/apache.conf /etc/apache2/sites-available/000-default.conf

# Ativa módulos do Apache
RUN a2enmod rewrite

# Define o diretório raiz do servidor
WORKDIR /var/www/html

# Copia o código do site
COPY ./public_html /var/www/html


