FROM ubuntu:20.04

LABEL org.opencontainers.image.authors="mggk@protonmail.ch"

## Update system
RUN apt-get update && apt-get upgrade -y

## Install dependencies
RUN apt-get install curl -y

## Install PHP8
RUN apt-get install software-properties-common -y
RUN add-apt-repository ppa:ondrej/php
RUN apt-get install php8.0 php8.0-dom libapache2-mod-php8.0 -y

## Install NodeJS
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | sudo -E bash -
RUN apt-get install -y nodejs

## Install Pupeteer
RUN npm install -g puppeteer