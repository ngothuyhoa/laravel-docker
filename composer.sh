#!/bin/bash

composer install

# Check if .env is existed?
if [[ !-e .env ]]; then
	cp .env.example .env
fi

# Generate key
php artisan key:generate
