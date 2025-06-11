FROM php:8.2-apache

RUN a2enmod rewrite

# sets document root to public folder in laravel app
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Uupdate apache config to point to the laravel public folder
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf \
    && echo '<Directory /var/www/html/public>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/laravel.conf \
    && a2enconf laravel

# then install laravel required dependancies 
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip curl git \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# also install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# copy everything from current working dir into /html dir 
COPY . /var/www/html

# also set the working dir to prevent needing absolute paths for commands
WORKDIR /var/www/html

RUN composer install --no-dev --optimize-autoloader

# update permissions to prevent 403 forbbidden errrors
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html
