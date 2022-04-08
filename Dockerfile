FROM debian:10-slim
RUN apt -y update && \
    apt -y install  ca-certificates apt-transport-https software-properties-common && \
    echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/sury-php.list && \
    wget -qO - https://packages.sury.org/php/apt.gpg | sudo apt-key add - && \
    apt-get install git nodejs libcurl4-gnutls-dev libicu-dev libmcrypt-dev libvpx-dev libjpeg-dev libpng-dev libxpm-dev zlib1g-dev libfreetype6-dev libxml2-dev libexpat1-dev libbz2-dev libgmp3-dev libldap2-dev unixodbc-dev libpq-dev libsqlite3-dev libaspell-dev libsnmp-dev libpcre3-dev libtidy-dev -yqq && \
    apt -y update && \
    apt -y install php-8.0 && \
    apt install php8.0-* && \
    apt -y install composer && \
    composer install && \
    composer update && \
    php artisan migrate:rollback && \
    php artisan migrate

VOLUME /app
CMD ["php", "artisan", "serve"];
