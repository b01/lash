FROM alpine:3.9

COPY ./docker/app/get-composer.sh ./

RUN chmod +x ./get-composer.sh \
 && apk --progress --purge --no-cache upgrade \
 && apk --no-progress --purge --no-cache add --upgrade \
    curl \
    php7 \
    php7-cgi \
    php7-curl \
    php7-fpm \
    php7-iconv \
    php7-json \
    php7-mbstring \
    php7-mcrypt \
    php7-openssl \
    php7-phar \
    php7-session \
    php7-simplexml \
    php7-tokenizer \
    php7-xdebug \
    php7-xml \
    php7-xmlreader \
    php7-xmlwriter \
 && ./get-composer.sh \
 && rm ./get-composer.sh \
 && composer -V \
 && curl http://get.sensiolabs.org/sami.phar -o /usr/local/bin/sami.phar \
 && chmod +x /usr/local/bin/sami.phar \
 && sami.phar -V \
 && apk --progress --purge --no-cache upgrade \
 && rm -vrf /var/cache/apk/*

# Run PHP as non root user.
RUN addgroup -S phpfpm \
 && adduser -D phpfpmuser \
 && addgroup phpfpmuser phpfpm \
 && addgroup root phpfpm \
 && mkdir -p /var/lib/php7/session \
 && chown phpfpmuser:phpfpm /var/lib/php7/session

COPY ./docker/app/php.ini /etc/php7/
COPY ./docker/app/php-fpm.conf /etc/php7/
COPY ./docker/app/www.conf /etc/php7/php-fpm.d/

ENTRYPOINT ["php-fpm7"]
CMD ["--fpm-config", "/etc/php7/php-fpm.conf", "-c", "/etc/php7/php.ini"]
