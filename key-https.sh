#!/bin/bash

certDir="/var/www/nginx/certs"

if [ ! -f "$certDir/server.key" ]; then
	touch "$certDir/server.key"
	openssl genrsa 2048 > "$certDir/server.key"
	openssl req -new -x509 -nodes -days 365 -subj "/C=VN/ST=Ha Noi/L=Ha Noi City/O=Test/OU=Test/CN=Test" -key "$certDir/server.key" -out "$certDir/server.crt"
fi

nginx -g "daemon off;"
