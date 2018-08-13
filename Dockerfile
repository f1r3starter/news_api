FROM yiisoftware/yii2-php:7.1-apache

ADD wait.sh /root/
RUN chmod +x /root/wait.sh
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/1b137f8bf6db3e79a38a5bc45324414a6b1f9df2/web/installer -O - -q | php -- --quiet
RUN composer install