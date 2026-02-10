FROM php:8.2-apache

# Enable Apache rewrite (optional but good)
RUN a2enmod rewrite

# Enable mysqli
RUN docker-php-ext-install mysqli

# Set Apache to listen on 8080 (Railway requirement)
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf \
    && sed -i 's/:80/:8080/g' /etc/apache2/sites-available/000-default.conf

# Copy app
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 8080
