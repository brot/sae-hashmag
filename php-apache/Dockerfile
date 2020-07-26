# https://www.php.net/
# https://hub.docker.com/_/php
# https://hub.docker.com/_/php?tab=tags&page=1&name=7.4-apache
FROM php:7.4-apache
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
