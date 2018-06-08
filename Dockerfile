FROM wordpress
ADD ./uploads.ini /usr/local/etc/php/conf.d/uploads.ini
ADD ./themes /tmp/
COPY run.sh /run.sh
RUN chmod +x /run.sh