FROM php:8.2-cli

WORKDIR /var/www/html

# Enable mysqli extension
RUN docker-php-ext-install mysqli

# Copy app code
COPY . /var/www/html/

# Expose default HTTP port (Railway will map this)
EXPOSE 8080

# Run PHP's built-in web server (no Apache, no MPM issues)
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-8080} -t /var/www/html"]