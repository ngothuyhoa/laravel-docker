#!/bin/sh

composer install

# Check if .env is existed?
if [[ ! -e .env ]]; then
	cp .env.example .env

	# Generate key
	php artisan key:generate
fi

