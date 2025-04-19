#!/bin/bash

# ↓権限をつけるのをわすれないでね.. 
# chmod +x .vscode/run-laravel-test.sh

# 最後の引数をテストファイルとみなす
FILE_PATH="${@: -1}"

# src/ を /var/www/html に置き換え（シンプルな置換）
CONTAINER_PATH="${FILE_PATH/src//var/www/html}"

# 他の引数（--filterなど）は配列に保持
ARGS=($@)
unset 'ARGS[${#ARGS[@]}-1]'

# 実行ログ確認（任意）
echo "Running: docker exec -i laravel_app ./vendor/bin/pest --colors=always $CONTAINER_PATH ${ARGS[@]}"

# Dockerで実行
docker exec -i laravel_app ./vendor/bin/pest --colors=always "$CONTAINER_PATH" "${ARGS[@]}"

#こっちでもOK  docker exec -i laravel_app php artisan test --colors=always "$CONTAINER_PATH" "${ARGS[@]}"