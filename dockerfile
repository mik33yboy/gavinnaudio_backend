FROM php:8.2-apache

# Disable other MPMs, enable prefork
RUN a2dismod mpm_event mpm_worker \
    && a2enmod mpm_prefork

# Enable mysqli
RUN docker-php-ext-install mysqli

# Copy app
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html
