location ~ \.php$ {
    try_files $uri =404;
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_pass app:9000; # Tên service Laravel trong Docker
    fastcgi_index index.php;
    include fastcgi_params;

    # CỰC KỲ QUAN TRỌNG:
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    
    # Truyền các header này để Laravel biết domain và giao thực thật
    fastcgi_param HTTP_X_FORWARDED_FOR $proxy_add_x_forwarded_for;
    fastcgi_param HTTP_X_FORWARDED_PROTO $scheme;
    fastcgi_param HTTP_HOST $http_host; 
}

// routes/web.php
Route::get('/debug-url', function () {
    return [
        'full_url' => url()->current(),
        'base_url' => config('app.url'),
        'host_header' => request()->header('host'),
        'scheme' => request()->getScheme(), // Sẽ là http hay https?
        'client_ip' => request()->ip(),
    ];
});

location ~* \.(jpg|jpeg|png|gif|webp|ico|css|js)$ {
    expires 365d;
    add_header Cache-Control "public, no-transform";
}

Tại sao nên dùng Wrangler thay vì chạy workerd thủ công

npx wrangler dev

npx wrangler deploy