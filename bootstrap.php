<?php

require_once __DIR__ . '/public/index.php';

const PHPUnit_MAIN_METHOD = true;
// Check if PHPUnit is running
if (defined('PHPUnit_MAIN_METHOD')) {
    // Disable the custom error and exception handling
    restore_error_handler();
    restore_exception_handler();
}
