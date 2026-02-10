FROM php:8.2-apache

# Enable mysqli
RUN docker-php-ext-install mysqli

# Enable rewrite
RUN a2enmod rewrite

# Tell Apache to listen on 8080 (Railway)
ENV APACHE_LISTEN_PORT=8080
RUN sed -i "s/Listen 80/Listen 8080/" /etc/apache2/ports.conf

# Copy app
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 8080
