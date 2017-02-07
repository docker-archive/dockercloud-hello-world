FROM alpine:3.4

RUN apk --update add nginx php5-fpm && \
    mkdir -p /run/nginx

ADD www /www
ADD nginx.conf /etc/nginx/
ADD php-fpm.conf /etc/php5/php-fpm.conf

EXPOSE 80
CMD php-fpm -d variables_order="EGPCS" && exec nginx -g "daemon off;"
