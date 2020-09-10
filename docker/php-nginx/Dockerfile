FROM php:7.4-fpm-alpine

ENV \
    S6_BEHAVIOUR_IF_STAGE2_FAILS=2 \
    S6_KEEP_ENV=1 \
    S6_READ_ONLY_ROOT=1


RUN set -e -u -x \
\
    # Install packages
\
    && apk add --no-cache --no-progress --virtual BUILD_DEPS ${PHPIZE_DEPS} gnupg \
    && apk add --no-cache --no-progress bash ca-certificates nginx nginx-mod-http-headers-more shadow tzdata \
\
    # Configure timezone
\
    && cp /usr/share/zoneinfo/Europe/Paris /etc/localtime \
    && echo "Europe/Paris" >  /etc/timezone \
\
    # Install s6-overlay
\
    && curl --location "https://keybase.io/justcontainers/key.asc" | gpg --import \
    && curl --location --output /tmp/s6-overlay.tar.gz "https://github.com/just-containers/s6-overlay/releases/download/v1.22.1.0/s6-overlay-amd64.tar.gz" \
    && curl --location --output /tmp/s6-overlay.tar.gz.sig "https://github.com/just-containers/s6-overlay/releases/download/v1.22.1.0/s6-overlay-amd64.tar.gz.sig" \
    && gpg --verify /tmp/s6-overlay.tar.gz.sig /tmp/s6-overlay.tar.gz \
    && tar --directory / --extract --file /tmp/s6-overlay.tar.gz --gzip \
\
    # Clean
\
    && apk del --no-progress BUILD_DEPS \
    && rm -f -r /root/.gnupg /tmp/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

COPY rootfs/ /

ENTRYPOINT [ "/init" ]
