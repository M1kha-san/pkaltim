<?php
/**
 * Configuration File
 * Sistem Informasi Wisata Alam Kaltim
 */

// Database Configuration (from .env)
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'wisata_alam_kaltim');

// Application Configuration (from .env)
define('BASE_URL', $_ENV['BASE_URL'] ?? 'http://localhost/pkaltim-tim02-main/');
define('APP_NAME', $_ENV['APP_NAME'] ?? 'Wisata Alam Kaltim');
define('APP_VERSION', $_ENV['APP_VERSION'] ?? '1.0.0');
define('ENVIRONMENT', $_ENV['APP_ENV'] ?? 'development'); // 'development' or 'production'

// API Keys (from .env)
define('WEATHER_API_KEY', $_ENV['WEATHER_API_KEY'] ?? '');

// Path Configuration
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('VIEW_PATH', APP_PATH . '/views');
define('PUBLIC_PATH', ROOT_PATH . '/public');

// Timezone (from .env)
date_default_timezone_set($_ENV['APP_TIMEZONE'] ?? 'Asia/Makassar');

// Error Reporting (Auto-configure based on environment)
if (ENVIRONMENT === 'production') {
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', ROOT_PATH . '/logs/error.log');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

// Session Configuration
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
