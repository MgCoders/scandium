FROM wordpress
ADD ./uploads.ini /usr/local/etc/php/conf.d/uploads.ini
RUN mkdir /tmp/themes
ADD ./themes /tmp/themes/
RUN chown -R www-data:www-data /tmp/themes
COPY run.sh /run.sh
RUN chmod +x /run.sh
CMD ["/run.sh"]