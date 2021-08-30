FROM nginx:1.19.6

RUN mkdir -p /etc/nginx/templates \
    mkdir -p /tmp/nginx

COPY nginx.conf /etc/nginx/
COPY templates/default.conf /etc/nginx/conf.d/
COPY templates/php-upstream.conf /etc/nginx/conf.d/

CMD ["nginx"]

EXPOSE 80
