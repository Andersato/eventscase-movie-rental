FROM php:7.4-apache

# Instalamos composer
COPY --from=composer /usr/bin/composer /usr/bin/composer


#RUN apt-get update && apt-get install -y libmcrypt-dev git \
#    mysql-client zip unzip libmagickwand-dev --no-install-recommends \
#    && pecl install imagick \
#    && pecl install mcrypt-1.0.1 \
#    && pecl install xdebug \
#    && docker-php-ext-enable imagick \
#    && docker-php-ext-enable mcrypt \
#    && docker-php-ext-enable xdebug \
#    && docker-php-ext-install pdo_mysql \
#    && a2enmod rewrite \
#    && service apache2 restart

# Install Composer
#RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
#    php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
#    php composer-setup.php && \
#    php -r "unlink('composer-setup.php');"

# Dependencias Node
RUN curl -sL https://deb.nodesource.com/setup_15.x | bash -
RUN apt-get update && apt-get install -y nodejs libmcrypt-dev git zip unzip

#RUN curl -sL https://rpm.nodesource.com/setup_12.x | bash - && \
#    yum -y install nodejs && \
#    npm install \
#     bower \
#     yarn \
#     uglify-js@2.7.0 yarn -g

RUN docker-php-ext-install pdo_mysql

ADD ./etc/docker/php/php.ini /etc/php.ini

WORKDIR /var/www/html