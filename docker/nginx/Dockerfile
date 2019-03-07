FROM alpine:3.8

# Install Nginx, OpenSSL and Vim
RUN apk update && apk add nginx openssl vim

# Sets Nginx configuration files from host into the image
COPY config/nginx.conf /etc/nginx/nginx.conf
ADD config/sites-enabled /etc/nginx/sites-enabled

RUN mkdir /etc/nginx/certs

# Generates a certificate to use for HTTPS
RUN openssl req \
        -x509 \
        -nodes \
        -days 365 \
        -newkey rsa:2048 \
        -keyout /etc/nginx/certs/pumpkin-test-backend.key \
        -out /etc/nginx/certs/pumpkin-test-backend.crt \
        -subj "/C=FR/ST=59/L=Lille/O=Pumpkin/OU=Pumpkin Test Backend/CN=test-backend.local"

# Creates the www-data user if it doesn't exist
RUN set -x ; \
  addgroup -g 82 -S www-data ; \
  adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

# Sets the working directory as the app directory
WORKDIR /var/www/html

# Exposes default HTTP and HTTPS ports
EXPOSE 80
EXPOSE 443

# Starts Nginx
CMD ["nginx"]
