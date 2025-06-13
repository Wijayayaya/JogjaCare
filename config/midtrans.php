<?php

return [
    // Server Key untuk autentikasi dengan Midtrans API
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    
    // Client Key untuk frontend integration
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    
    // Environment: false = sandbox, true = production
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    
    // Sanitasi input untuk keamanan
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    
    // 3D Secure untuk kartu kredit
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
    
    // URL untuk notification callback
    'notification_url' => env('APP_URL') . '/payment/notification',
    
    // URL redirect setelah pembayaran
    'finish_url' => env('APP_URL') . '/expert-system',
    'unfinish_url' => env('APP_URL') . '/expert-system/payment',
    'error_url' => env('APP_URL') . '/expert-system/payment',
];