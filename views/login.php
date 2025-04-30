<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Iniciar Sesión</title>
    <link rel="stylesheet" href="views/assets/css/style.css">
</head>
<body class="login">
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

            <!-- Mensaje flash tradicional (por si se recarga con errores) -->
            <?php
            $flashMessage = getFlashMessage();
            if ($flashMessage) {
                echo '<div class="flash-message flash-' . $flashMessage['type'] . '">' . $flashMessage['message'] . '</div>';
            }
            ?>

            <form id="loginForm">
                <div class="input-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="flash-message flash-error" id="error-message" style="display: none;"></div>
                
                <button type="submit">Ingresar</button>
            </form>

            <div>&nbsp;</div>
            <div class="register-link">
                <p><a href="index.php?controller=Auth&action=forgot">¿Olvidaste tu contraseña?</a></p>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevenir el envío normal del formulario

        const form = e.target;
        const formData = new FormData(form);
        const errorBox = document.getElementById('error-message');

        fetch('index.php?controller=Auth&action=login', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // animación del candado
                document.getElementById('lock').classList.add('unlocked');

                setTimeout(() => {
                    window.location.href = 'index.php?controller=Dashboard&action=index';
                }, 700); // Esperar a que termine la animación
            } else {
                errorBox.style.display = 'block';
                errorBox.innerText = data.message;
            }
        })
        .catch(err => {
            errorBox.style.display = 'block';
            errorBox.innerText = 'Error en la solicitud. Intente nuevamente.';
            console.error('Error en login:', err);
        });
    });
    </script>
</body>
</html>
