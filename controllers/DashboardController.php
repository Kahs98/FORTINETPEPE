<?php
/**
 * Controlador del Dashboard
 * Maneja la página principal después del login
 */
class DashboardController {
    private $userModel;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->userModel = new UserModel();
    }
    
    /**
     * Mostrar el dashboard
     */
    public function index() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
            redirect('index.php?controller=Auth&action=index');
        }
        
        // Obtener información del usuario
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        
        // Incluir la vista del dashboard
        include 'views/dashboard.php';
    }
    
    /**
     * Mostrar perfil del usuario
     */
    public function profile() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
            redirect('index.php?controller=Auth&action=index');
        }
        
        // Obtener información del usuario
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        
        // Incluir la vista del perfil
        include 'views/profile.php';
    }
}