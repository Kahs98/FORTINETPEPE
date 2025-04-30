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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
    
            if (empty($username) || empty($password)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Por favor complete todos los campos'
                ]);
                exit;
            }
    
            $user = $this->userModel->authenticate($username, $password);
    
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['is_logged_in'] = true;
    
                echo json_encode([
                    'success' => true,
                    'message' => 'Inicio de sesión exitoso'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Usuario o contraseña incorrectos'
                ]);
            }
            exit;
        }
    
        // Redirección de seguridad
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

        /**
     * Mostrar formulario para recuperar contraseña
     */
    public function forgot() {
        if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {
            redirect('index.php?controller=Dashboard&action=index');
        }
    
        include 'views/forgot_password.php';
    }
    

    public function sendResetEmail() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    
            if (empty($email)) {
                setFlashMessage('error', 'Por favor ingrese su correo electrónico');
                redirect('index.php?controller=Auth&action=forgot');
            }
    
            // Aquí podrías enviar el correo, buscar al usuario, generar token, etc.
            setFlashMessage('success', 'Si el correo está registrado, recibirás un mensaje con instrucciones.');
            redirect('index.php?controller=Auth&action=index');
        }
    
        redirect('index.php?controller=Auth&action=forgot');
    }
    
}