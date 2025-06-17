#!/bin/bash

# Git pull
git pull

# Docker compose rebuild and start
docker compose up --build -d

# Get container ID
CONTAINER_ID=$(docker ps -qf "name=autoparts-pasha-web-1")

# Execute BOM removal command inside container
docker exec -it $CONTAINER_ID bash -c 'find /var/www/html -type f -name "*.php" -exec sed -i '\''1s/^\xEF\xBB\xBF//'\'' {} \;'