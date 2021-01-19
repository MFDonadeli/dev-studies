FROM php:7.4-cli AS builder

WORKDIR /var/www

RUN apt-get update && \
    apt-get install libzip-dev -y && \
    docker-php-ext-install zip 
    #this last one is a command created by php community to install zip files in php

#install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');"

#install Laravel
RUN php composer.phar create-project --prefer-dist laravel/laravel laravel

#run Laravel server - i don't know why is not configured
#ENTRYPOINT ["php", "laravel/artisan", "serve"]

#to be able to redirect to my port - i don't know why is not configured
#CMD ["--host=0.0.0.0"]

#run like this: docker run --rm -d --name laravel -p 8000:8000 wesleywillians/laravel
#to change to other host and port: docker run --rm -d --name laravel -p 8001:8001 wesleywillians/laravel --host=0.0.0.0 --port=8001

#No server, so I will run with Nginx
FROM php:7.4-fpm-alpine

WORKDIR /var/www

#remove html folder
RUN rm -rf /var/www/html

#copy from stage "builder" (line 1) laravel dir to current directory
COPY --from=builder /var/www/laravel .

#create a symbolic link to public be known as html
RUN ln -s public html
RUN chown -R www-data:www-data /var/www


EXPOSE 9000

CMD ["php-fpm"]