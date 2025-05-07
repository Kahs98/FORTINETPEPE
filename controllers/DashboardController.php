<?php
// controllers/DashboardController.php

// Si no usas autoloader, descomenta la siguiente línea para cargar el modelo
// require_once __DIR__ . '/../models/UserModel.php';

class DashboardController {
    private $userModel;

    public function __construct() {
        // Arrancar la sesión si no está activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Instanciar el modelo de usuario
        $this->userModel = new UserModel();
    }

    /**
     * Mostrar el dashboard principal
     */
    public function index() {
        // 1) Verificar autenticación
        if (empty($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
            header('Location: index.php?controller=Auth&action=index');
            exit;
        }

        // 2) Obtener datos del usuario
        $user = $this->userModel->getUserById($_SESSION['user_id']);

        // 3) Recoger página solicitada
        $page = $_GET['page'] ?? '';

        // 4) Incluir la vista del dashboard
        include __DIR__ . '/../views/dashboard.php';
    }

    /**
     * Mostrar el perfil del usuario
     */
    public function profile() {
        // Verificar autenticación
        if (empty($_SESSION['is_logged_in']) || !$_SESSION['is_logged_in']) {
            header('Location: index.php?controller=Auth&action=index');
            exit;
        }

        // Obtener datos del usuario
        $user = $this->userModel->getUserById($_SESSION['user_id']);

        // Incluir la vista de perfil
        include __DIR__ . '/../views/profile.php';
    }
}
