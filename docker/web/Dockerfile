FROM nginx:1-alpine

# Add helper files.
COPY ./docker/web/custom-nginx.conf /etc/nginx/
COPY ./docker/web/generate-self-signed-cert.sh /bin/

# Install some dependencies.
RUN apk --update add --no-cache \
    openssl \
 && chmod a+x /bin/generate-self-signed-cert.sh \
 && generate-self-signed-cert.sh \
 && ln -sf /dev/stdout /var/log/nginx/access.log \
 && ln -sf /dev/stderr /var/log/nginx/error.log \
 && nginx -v

# Add nginx configuration for lash web server.
COPY ./docker/web/lash.conf /etc/nginx/conf.d/default.conf

ENTRYPOINT ["nginx"]
CMD ["-c", "/etc/nginx/custom-nginx.conf"]