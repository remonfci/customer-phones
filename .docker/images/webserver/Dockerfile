FROM nginx:1.19.4

CMD ["nginx"]

COPY /.docker/images/webserver/conf.d /etc/nginx/conf.d
COPY /.docker/images/webserver/nginx.conf /etc/nginx/nginx.conf
COPY /.docker/images/webserver/sites/code.conf /etc/nginx/sites-available/default.conf

EXPOSE 80
