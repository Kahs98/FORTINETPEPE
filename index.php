    <?php
    /**
    * Front Controller - Punto de entrada para la aplicación
    * Gestiona todas las solicitudes y las dirige al controlador correspondiente
    */

    // Iniciar sesión
    session_start();

    // Incluir archivos de configuración
    require_once 'config/config.php';

    // Autocargar clases
    spl_autoload_register(function($className) {
        // Convertir namespace a ruta de archivo
        $parts = explode('\\', $className);
        $className = end($parts);
        
        // Buscar la clase en directorios de la aplicación
        $directories = ['controllers', 'models'];
        
        foreach ($directories as $directory) {
            $file = $directory . '/' . $className . '.php';
            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    });

    // Determinar la acción a realizar
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'Auth';
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';

    // Verificar si el usuario está autenticado
    $publicActions = ['Auth.index', 'Auth.login', 'Auth.register', 'Auth.forgot', 'Auth.sendResetEmail'];
    $isPublicAction = in_array("$controller.$action", $publicActions);

    if (!isset($_SESSION['is_logged_in']) && !$isPublicAction) {
        // Redirigir al login si no está autenticado
        header('Location: index.php?controller=Auth&action=index');
        exit();
    }

    // Crear la instancia del controlador
    $controllerClass = $controller . 'Controller';
    if (!class_exists($controllerClass)) {
        die("El controlador $controllerClass no existe");
    }

    $controllerInstance = new $controllerClass();

    // Verificar si la acción existe en el controlador
    if (!method_exists($controllerInstance, $action)) {
        die("La acción $action no existe en el controlador $controllerClass");
    }

    // Ejecutar la acción
    $controllerInstance->$action();

    ?>