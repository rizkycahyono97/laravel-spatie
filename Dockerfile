# Base image
FROM dunglas/frankenphp:1.2

# Install dependencies (composer, npm, dan pdo_mysql)
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    git \
    nodejs \
    npm \
    default-libmysqlclient-dev && docker-php-ext-install pdo_mysql pcntl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install 

# Install Node.js dependencies
RUN npm install && npm install vite --save-dev

# Run Vite build
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Configure environment
COPY .env.example .env
RUN php artisan key:generate

# Database seeding
# RUN php artisan migrate:fresh \
#     && php artisan db:seed --class=RolePermissionSeeder \
#     && php artisan db:seed

# Expose port for FrankenPHP
EXPOSE 8080

# Start FrankenPHP
CMD ["php", "artisan", "octane:start", "--server=frankenphp", "--host=0.0.0.0", "--port=8080"]
