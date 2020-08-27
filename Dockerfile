FROM php:apache
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load

COPY ./app/ /var/www/html