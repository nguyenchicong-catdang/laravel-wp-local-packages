#!/bin/bash

# Đường dẫn đến thư mục uploads của WordPress
WP_UPLOADS_DIR="$HOME/git/laravel-wp/wp-app/uploads"
# Đường dẫn đến thư mục public/uploads của Laravel
LARAVEL_UPLOADS_DIR="$HOME/git/laravel-wp/laravel-app/public/uploads"
# Kiểm tra nếu thư mục uploads của WordPress tồn tại
if [ -d "$WP_UPLOADS_DIR" ]; then
    # Tạo liên kết tượng trưng nếu chưa tồn tại
    if [ ! -L "$LARAVEL_UPLOADS_DIR" ]; then
        ln -s "$WP_UPLOADS_DIR" "$LARAVEL_UPLOADS_DIR"
        echo "Đã tạo liên kết tượng trưng từ $WP_UPLOADS_DIR đến $LARAVEL_UPLOADS_DIR"
    else
        echo "Liên kết tượng trưng đã tồn tại: $LARAVEL_UPLOADS_DIR"
    fi
else
    echo "Thư mục uploads của WordPress không tồn tại: $WP_UPLOADS_DIR"
fi

# . ~/git/laravel-wp/laravel-app/vendor/ncc/laravel-wp-local-packages/Wp/setup/link-uploads.sh