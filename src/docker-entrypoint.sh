#!/bin/bash
cd src
touch storage/logs/laravel.log
chown -R www-data:www-data storage/logs/
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=AdminSeeder
php artisan storage:link
php artisan optimize
apache2-foreground
