FROM php:8.2-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

ENV DB_PATH=/data/notes.sqlite

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf \
    && printf 'ServerName localhost\n<Directory ${APACHE_DOCUMENT_ROOT}>\n    FallbackResource /index.php\n</Directory>\n' \
    > /etc/apache2/conf-available/app.conf \
    && a2enconf app \
    && mkdir -p /data \
    && chown www-data:www-data /data

WORKDIR /var/www/html

COPY src/ /var/www/html/

# Persistent storage for the SQLite database
VOLUME /data

EXPOSE 80

# Start Apache in the foreground so the container keeps running
CMD ["apache2-foreground"]