FROM serversideup/php:8.4-fpm-nginx

# Set the working directory
WORKDIR /var/www/html

# Copy application files
COPY --chown=www-data:www-data . .

# Run composer installation hooks securely
RUN composer install --no-dev --optimize-autoloader

# Expose port and start internal systems
EXPOSE 8080