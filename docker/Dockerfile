FROM ubuntu:20.04

LABEL org.opencontainers.image.authors="mggk@protonmail.ch"

## Update system
RUN apt-get update && apt-get upgrade -y

## Install dependencies
RUN apt-get install git curl && \
    libnss3 libatk1.0-0 libatk-bridge2.0-0 libcups2 libdrm2 libxkbcommon0 libxcomposite1 libxdamage1 libxfixes3 libxrandr2 && \
    libgbm1 libpango-1.0-0 libcairo2 -y

## Install PHP8
RUN DEBIAN_FRONTEND=noninteractive apt-get install software-properties-common -y
RUN add-apt-repository ppa:ondrej/php
RUN apt-get install apache2 -y && a2enmod rewrite
RUN apt-get install php8.0 php8.0-dom php8.0-zip libapache2-mod-php8.0 -y

COPY apache.conf /etc/apache2/sites-enabled/000-default.conf

## Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

## Install NodeJS
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -
RUN apt-get install -y nodejs

## Install Pupeteer
RUN npm install -g puppeteer

## Install FreeXPdf
RUN cd /var/www && \
    git clone https://github.com/mGGk-fr/freexpdf.git

## Setup FreeXPdf
COPY .env /var/www/freexpdf/.env
RUN cd /var/www/freexpdf && \
    composer install

EXPOSE 80
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]