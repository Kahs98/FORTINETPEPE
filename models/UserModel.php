<?php
/**
 * Modelo de Usuario
 * Gestiona todas las operaciones relacionadas con los usuarios en la base de datos
 */
class UserModel {
    private $db;

    /**
     * Constructor
     */
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Buscar un usuario por su nombre de usuario
     * 
     * @param string $username Nombre de usuario
     * @return array|false Datos del usuario o false si no existe
     */
    public function getUserByUsername($username) {
        try {
            $query = "SELECT * FROM users WHERE username = :username";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();
            
            return $statement->fetch();
        } catch (PDOException $e) {
            error_log('Error en getUserByUsername: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtener un usuario por su ID
     * 
     * @param int $id ID del usuario
     * @return array|false Datos del usuario o false si no existe
     */
    public function getUserById($id) {
        try {
            $query = "SELECT * FROM users WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            
            return $statement->fetch();
        } catch (PDOException $e) {
            error_log('Error en getUserById: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Crear un nuevo usuario
     * 
     * @param string $username Nombre de usuario
     * @param string $password Contraseña (sin hashear)
     * @param string $email Correo electrónico
     * @return int|false ID del usuario creado o false si hay un error
     */
    public function createUser($username, $password, $email) {
        try {
            // Hashear la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $query = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
            $statement = $this->db->prepare($query);
            
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            
            $statement->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log('Error en createUser: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Verificar si las credenciales son válidas
     * 
     * @param string $username Nombre de usuario
     * @param string $password Contraseña
     * @return array|false Datos del usuario si las credenciales son válidas, false en caso contrario
     */
    public function authenticate($username, $password) {
        $user = $this->getUserByUsername($username);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }

    public function isValidToken($token) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_token_expire > NOW()");
        $stmt->execute([$token]);
        return $stmt->fetch();
    }
    
    
    public function updatePasswordByToken($token, $newPassword) {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_token_expire = NULL WHERE reset_token = ?");
        return $stmt->execute([$hashed, $token]);
    }
    
    
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        
    public function guardarToken($userId, $token, $expira) {
        $stmt = $this->db->prepare("UPDATE users SET reset_token = ?, reset_token_expire = ? WHERE id = ?");
        return $stmt->execute([$token, $expira, $userId]);
    }
    
    
}