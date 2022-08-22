#!/bin/bash

php artisan migrate
php artisan passport:install
composer dumpautoload