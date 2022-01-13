FROM php:7.4-cli
COPY . /usr/src/commissions
WORKDIR /usr/src/commissions
RUN apt clean && apt update && apt install -y \
            wget \
            git \
            zlib1g-dev \
            libzip-dev
RUN docker-php-ext-install zip
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/d4525508b60af43a52f274d70315bfed4d671fd3/web/installer -O - -q | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --working-dir=/usr/src/commissions