<?php

namespace App;

use \App\Helpers\DotEnv;
/**
 * Application configuration
 *
 * PHP version 7.0
 */

(new DotEnv(ROOT . '.env'))->load();
return
[
    //
    // Cookie Config
    // =========================================================================
    "COOKIE_DEFAULT_EXPIRY" => 604800,
    "COOKIE_USER" => "user",
    //
    // Core Config
    // =========================================================================
    "DB_HOST" => getenv('DB_HOST'),
    "DB_PORT" => getenv('TARGET_DB_PORT'),
    "DB_NAME" => getenv('DB_NAME'),
    "DB_USER" => getenv('DB_USER'),
    "DB_PASSWORD" => getenv('DB_PASSWORD'),
    "SHOW_ERRORS" => true,
];
