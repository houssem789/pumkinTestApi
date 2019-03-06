FROM alpine:3.8

# Install Nginx, Vim
RUN apk update && apk add nginx vim

# Sets Nginx configuration files from host into the image
COPY config/nginx.conf /etc/nginx/nginx.conf
ADD config/sites-enabled /etc/nginx/sites-enabled

RUN mkdir /etc/nginx/certs

# Creates the www-data user if it doesn't exist
RUN set -x ; \
  addgroup -g 82 -S www-data ; \
  adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

# Sets the working directory as the app directory
WORKDIR /var/www/html

EXPOSE 80

# Starts Nginx
CMD ["nginx"]
