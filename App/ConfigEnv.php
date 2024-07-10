<?php

namespace App;

use \App\Helpers\DotEnv;

/**
 * Application configuration
 *
 * PHP version 7.0
 */

// Assurez-vous que ROOT est défini avant d'utiliser DotEnv
if (!defined('ROOT')) {
    define('ROOT', '/var/www/html/');  // Assurez-vous que ce chemin est correct
}

// Chargez les variables d'environnement depuis le fichier .env
(new DotEnv(ROOT . '.env'))->load();

return [
    //
    // Cookie Config
    // =========================================================================
    "COOKIE_DEFAULT_EXPIRY" => 604800,
    "COOKIE_USER" => "user",
    //
    // Core Config
    // =========================================================================
    "DB_HOST" => getenv('DB_HOST'),
    "DB_PORT" => getenv('DB_PORT'),  // Corrigé pour correspondre à la variable d'environnement
    "DB_NAME" => getenv('DB_NAME'),
    "DB_USER" => getenv('DB_USER'),
    "DB_PASSWORD" => getenv('DB_PASSWORD'),
    "SMTP_MAIL_ADRESS" => getenv('SMTP_MAIL_ADRESS'),
    "SMTP_MAIL_PASSWORD" => getenv('SMTP_MAIL_PASSWORD'),
    "SMTP_SERVER" => getenv('SMTP_SERVER'),
    "SHOW_ERRORS" => true,
];
