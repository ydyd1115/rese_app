#!/bin/bash

set -eux

cd ~/rese
php artisan migrate --force
php artisan config:cache