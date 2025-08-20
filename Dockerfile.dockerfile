# 使用官方 WordPress + Apache
FROM wordpress:php8.2-apache

# 必備：資料庫擴充 & 固定網址 rewrite
RUN docker-php-ext-install mysqli && a2enmod rewrite

# 把你的主題/外掛隨建置打包進容器
COPY wp-content/themes/ /var/www/html/wp-content/themes/
COPY wp-content/plugins/ /var/www/html/wp-content/plugins/

# 權限（避免上傳/寫入問題）
RUN chown -R www-data:www-data /var/www/html/wp-content