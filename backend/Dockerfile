FROM composer/composer:2-bin AS composer_upstream
FROM php:8.2-apache AS php_upstream
ARG DATABASE_URL

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2enmod rewrite

WORKDIR /var/www

ENV DATABASE_URL=${DATABASE_URL}
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"
COPY --from=composer_upstream --link /composer /usr/bin/composer

RUN set -eux; \
	apt-get update; \
	apt-get install -y libzip-dev zip ; \
	docker-php-ext-install mysqli pdo_mysql zip;


# prevent the reinstallation of vendors at every changes in the source code
COPY --link laravel-api/composer.* ./
RUN set -eux; \
	composer install --prefer-dist --no-autoloader --no-scripts --no-progress

# copy sources
COPY --link laravel-api ./

RUN set -eux; \
	chmod -R 755 storage; \
	composer dump-autoload;