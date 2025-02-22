# Используем официальный образ PHP в качестве базового образа
FROM php:8.2-fpm

# Установка рабочего каталога
WORKDIR /var/www/html

# Установка системных зависимостей и php расширений
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Установка расширений PHP
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl

# Очистка кеша
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Установка Composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Копирование существующего содержимого каталога приложения в рабочую директорию
COPY . /var/www

# Копирование существующего разрешения каталога приложения в рабочую директорию
COPY --chown=www-data:www-data . /var/www

# Изменение прав доступа к директориям кэша
RUN mkdir -p /var/www/.composer/cache && chown -R www-data:www-data /var/www/.composer

RUN chown -R www-data:www-data /var/www/html

# Смена текущего пользователя на www-data
USER www-data

# Открываем порт 9000 и запускаем сервер php-fpm
EXPOSE 9000
CMD ["php-fpm"]
