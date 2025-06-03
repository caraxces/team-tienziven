FROM php:8.1-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    libicu-dev \
    libpq-dev \
    libxml2-dev \
    libldap2-dev \
    curl \
    libcurl4-openssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql zip intl soap ldap opcache

# Cài đặt hiệu suất PHP
RUN echo "memory_limit = 256M" > /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "max_execution_time = 120" >> /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "upload_max_filesize = 20M" >> /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "post_max_size = 20M" >> /usr/local/etc/php/conf.d/memory-limit.ini \
    && echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=2" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini

# Copy file cấu hình và code
COPY ./ /var/www/html/

# Điều chỉnh quyền
RUN chown -R www-data:www-data /var/www/html/

# Cấu hình Apache
RUN a2enmod rewrite
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Thiết lập thư mục làm việc
WORKDIR /var/www/html

# Sửa lỗi date.timezone
RUN echo "date.timezone = UTC" > /usr/local/etc/php/conf.d/timezone.ini

EXPOSE 80

CMD ["apache2-foreground"] 