<?php

namespace Core;

use PDO;
use App\Helpers\Config;
use PDOException;

/**
 * Base model
 *
 * PHP version 7.0
 */
abstract class Model
{

    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getDB()
    {
        static $db = null;

        if ($db === null) {
            try {
                $dsn = 'mysql:host=' . Config::get("DB_HOST") .
                    ';port=' . Config::get("DB_PORT") .
                    ';dbname=' . Config::get("DB_NAME") .
                    ';charset=utf8';
                $db = new PDO($dsn, Config::get("DB_USER"), Config::get("DB_PASSWORD"));

                // Throw an Exception when an error occurs
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return $db;
    }
}
