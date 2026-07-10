FROM serversideup/php:8.4-fpm-nginx


WORKDIR /var/www/html

COPY --chown=www-data:www-data . .

RUN mkdir -p database && touch database/database.sqlite && chown -R www-data:www-data database

RUN composer install --no-dev --optimize-autoloader

EXPOSE 8080