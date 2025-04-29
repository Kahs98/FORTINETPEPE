<?php
/**
 * Controlador de Autenticación
 * Maneja login, logout y registro de usuarios
 */
class AuthController {
    private $userModel;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->userModel = new UserModel();
    }
    
    /**
     * Mostrar la página de login
     */
    public function index() {
        // Si ya está autenticado, redirigir al dashboard
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
            redirect('index.php?controller=Dashboard&action=index');
        }
        
        // Incluir la vista de login
        include 'views/login.php';
    }
    
    /**
     * Procesar solicitud de login (AJAX)
     */
    public function login() {
        // Verificar si es una solicitud AJAX y POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            
            // Validar datos
            if (empty($username) || empty($password)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Por favor complete todos los campos'
                ]);
                exit();
            }
            
            // Intentar autenticar al usuario
            $user = $this->userModel->authenticate($username, $password);
            
            if ($user) {
                // Autenticación exitosa
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_logged_in'] = true;
                
                echo json_encode([
                    'success' => true,
                    'message' => 'Inicio de sesión exitoso'
                ]);
            } else {
                // Autenticación fallida
                echo json_encode([
                    'success' => false,
                    'message' => 'Usuario o contraseña incorrectos'
                ]);
            }
            exit();
        }
        
        // Si no es POST, redirigir al login
        redirect('index.php?controller=Auth&action=index');
    }
    
    /**
     * Cerrar sesión
     */
    public function logout() {
        // Destruir datos de sesión
        session_unset();
        session_destroy();
        
        // Redirigir al login
        redirect('index.php?controller=Auth&action=index');
    }
    
    /**
     * Mostrar formulario de registro
     */
    public function register() {
        // Si ya está autenticado, redirigir al dashboard
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
            redirect('index.php?controller=Dashboard&action=index');
        }
        
        // Incluir la vista de registro
        include 'views/register.php';
    }
    
    /**
     * Procesar solicitud de registro
     */
    public function doRegister() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            
            // Validar datos
            if (empty($username) || empty($password) || empty($email)) {
                setFlashMessage('error', 'Por favor complete todos los campos');
                redirect('index.php?controller=Auth&action=register');
            }
            
            // Verificar si el usuario ya existe
            if ($this->userModel->getUserByUsername($username)) {
                setFlashMessage('error', 'El nombre de usuario ya está en uso');
                redirect('index.php?controller=Auth&action=register');
            }
            
            // Crear usuario
            $userId = $this->userModel->createUser($username, $password, $email);
            
            if ($userId) {
                setFlashMessage('success', 'Registro exitoso. Ahora puede iniciar sesión.');
                redirect('index.php?controller=Auth&action=index');
            } else {
                setFlashMessage('error', 'Error al registrar el usuario');
                redirect('index.php?controller=Auth&action=register');
            }
        }
        
        // Si no es POST, redirigir al formulario de registro
        redirect('index.php?controller=Auth&action=register');
    }
}