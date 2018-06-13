FROM wordpress
ADD ./uploads.ini /usr/local/etc/php/conf.d/uploads.ini
ADD ./themes /var/www/html/wp-content/themes
ADD ./themes /tmp/themes/
COPY apache2-custom.sh /usr/local/bin/apache2-custom.sh
RUN chmod +x /usr/local/bin/apache2-custom.sh