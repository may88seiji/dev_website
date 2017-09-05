FROM cinra/php56

ENV APP_ROOT /var/www
WORKDIR $APP_ROOT

COPY ./www /var/www/
COPY ./template/vhost.conf /etc/apache2/sites-enable/

RUN apt-get update
RUN apt-get install -y git \
                       zip \
                       unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# COPY ./html $APP_ROOT/html
# COPY ./composer.lock $APP_ROOT/composer.lock
# COPY ./composer.json $APP_ROOT/composer.json

RUN composer install --no-scripts

# RUN curl get.fuelphp.com/oil | sh
# COPY ./oil $APP_ROOT/oil

# RUN mkdir -p /var/www/fuel/app/cache && chmod -R 777 /var/www/fuel/app/cache