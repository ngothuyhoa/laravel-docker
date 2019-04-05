#!/bin/sh

composer install

# Check if .env is existed?
if [[ -e .env ]]; then
	rm .env
	cp .env.example .env
fi

# Generate key
php artisan key:generate
