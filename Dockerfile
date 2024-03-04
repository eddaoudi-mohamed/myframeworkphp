FROM php:8.3.2-apache

# Install necessary packages
RUN apt-get update && apt-get upgrade -y && apt-get install -y libmariadb-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql 

# Add application code
ADD . /var/www/html

# Install Composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Set environment variables in Apache configuration
RUN echo 'SetEnv MYSQL_DB_CONNECTION ${MYSQL_DB_CONNECTION}' >> /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv MYSQL_DB_NAME ${MYSQL_DB_NAME}' >> /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv MYSQL_USER ${MYSQL_USER}' >> /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv MYSQL_PASSWORD ${MYSQL_PASSWORD}' >> /etc/apache2/conf-enabled/environment.conf
RUN echo 'SetEnv SITE_URL ${SITE_URL}' >> /etc/apache2/conf-enabled/environment.conf

# Enable Apache modules and set server name
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf &&\
    a2enmod rewrite &&\
    a2enmod headers

# Expose ports
EXPOSE 80
EXPOSE 443

# Start Apache
CMD ["apache2-foreground"]
