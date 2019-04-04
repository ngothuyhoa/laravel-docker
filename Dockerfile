FROM php:7.2-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    mysql-client \
    unzip \
    git \
    vim \
    curl

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
# USER www

COPY ./composer.sh /scripts/composer.sh
RUN chmod -R a+x /scripts/composer.sh
# ENTRYPOINT ["/scripts/composer.sh"]

# Expose port 9000 and start php-fpm server
EXPOSE 9000
