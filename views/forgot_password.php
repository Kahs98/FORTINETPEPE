<!-- views/forgot_password.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar contraseña - <?= APP_NAME ?></title>
    <link rel="stylesheet" href="views/assets/css/style.css?v=<?= time() ?>">
</head>
<body class="login">
    <div class="container">
        <div class="login-box">
            <h2>¿Olvidaste tu contraseña?</h2>
            <p style="color: white;">Ingresa tu correo electrónico y te enviaremos instrucciones para restablecerla.</p>

            <form method="post" action="index.php?controller=Auth&action=sendResetEmail">
                <div class="input-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <button type="submit">Enviar instrucciones</button>
            </form>
        </div>
    </div>
</body>
</html>
