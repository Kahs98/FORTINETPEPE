<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Iniciar Sesión</title>
    <link rel="stylesheet" href="views/assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="lock-container">
                <div class="lock" id="lock">
                    <div class="lock-top"></div>
                    <div class="lock-body"></div>
                    <div class="keyhole"></div>
                </div>
            </div>
            
            <h2>Iniciar Sesión</h2>
            
            <?php
            // Mostrar mensaje flash si existe
            $flashMessage = getFlashMessage();
            if ($flashMessage) {
                echo '<div class="message ' . $flashMessage['type'] . '">' . $flashMessage['message'] . '</div>';
            }
            ?>
            
            <form id="loginForm" action="index.php?controller=Auth&action=login" method="post">
                <div class="input-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="error-message" id="error-message"></div>
                
                <button type="submit">Ingresar</button>
            </form>
            <div>&nbsp</div>
            <div class="register-link">
                <p>¿No tienes una cuenta? <a href="index.php?controller=Auth&action=register">Regístrate</a></p>
            </div>
        </div>
    </div>
    
    <script src="views/assets/js/script.js"></script>
</body>
</html>