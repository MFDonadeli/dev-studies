FROM nginx:1.15.0-alpine

#remove default configuration
RUN rm /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/conf.d

#to ensure that nginx will redirect from index.php to the url I want
RUN mkdir /var/www/html -p && touch /var/www/html/index.php

