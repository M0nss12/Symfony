FROM php:8.2-apache

# Установка необходимых расширений PHP
RUN docker-php-ext-install pdo pdo_mysql

# Включаем mod_rewrite для Apache
RUN a2enmod rewrite

# Копируем код проекта
COPY . /var/www/html/

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Устанавливаем зависимости
RUN composer install --no-dev --optimize-autoloader

# Настраиваем права
RUN chown -R www-data:www-data /var/www/html/var/

# Настраиваем Apache для Symfony
RUN echo '<Directory /var/www/html/public/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Указываем корневую директорию
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf