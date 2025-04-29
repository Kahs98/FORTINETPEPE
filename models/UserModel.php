<?php
/**
 * Clase de conexión a la base de datos
 * Implementa el patrón Singleton para mantener una única conexión
 */
class Database {
    private static $instance = null;
    private $connection;

    /**
     * Constructor privado para evitar instanciación directa
     */
    private function __construct() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->connection = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // En producción, manejar este error de forma más adecuada
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    /**
     * Obtener instancia de la conexión (Singleton)
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Obtener la conexión PDO
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * Evitar clonar la instancia
     */
    private function __clone() {}

    /**
     * Evitar deserializar la instancia
     */
    public function __wakeup() {
        throw new Exception("No se puede deserializar un singleton.");
    }
}