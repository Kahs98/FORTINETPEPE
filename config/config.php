<?php
/**
 * Archivo de configuración general
 */

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_govshield');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configuración de rutas
define('BASE_URL', 'http://localhost/FORTINETPEPE');

// Configuración de la aplicación
define('APP_NAME', 'Sistema de Login Seguro');
define('APP_VERSION', '1.0.0');

// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Zona horaria
date_default_timezone_set('America/Lima');

// Función para redireccionar
function redirect($url) {
    header('Location: ' . $url);
    exit();
}

// Función para mostrar mensajes flash
function setFlashMessage($type, $message) {
    $_SESSION['flash_message'] = [
        'type' => $type,
        'message' => $message
    ];
}

function getFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $message;
    }
    return null;
}