<!-- views/reset_password.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña</title>
    <link rel="stylesheet" href="views/assets/css/style.css?v=<?= time() ?>">
</head>
<body class="login">
    <div class="container">
        <div class="login-box">
            <h2>Restablecer Contraseña</h2>
            <form method="post" action="index.php?controller=Auth&action=doResetPassword">
                <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token']) ?>">
                <div class="input-group">
                    <label for="new_password">Nueva Contraseña</label>
                    <input type="password" id="new_password" name="new_password" required>
                </div>
                <button type="submit">Actualizar Contraseña</button>
            </form>
        </div>
    </div>
</body>
</html>
