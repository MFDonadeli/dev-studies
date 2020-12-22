FROM nginx:1.15.0-alpine

#remove default configuration
RUN rm /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/conf.d/default.conf

RUN mkdir /var/www/html -p && touch /var/www/html/index.html