<?php
$ini = parse_ini_file(__DIR__ . '/passwords.ini', true);

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',

    // API ключ https://anti-captcha.com/
    'antiCaptcha' => [
        'clientKey' => $ini['antiCaptcha']['clientKey']
    ],


];
