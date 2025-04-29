<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Dashboard</title>
    <link rel="stylesheet" href="views/assets/css/style.css">
    <style>
        .dashboard {
            max-width: 1200px;
            margin: 40px auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .header {
            padding: 20px 30px;
            background: #fff;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .welcome {
            margin-right: 20px;
            font-size: 16px;
            color: #555;
        }
        
        .logout-btn {
            padding: 8px 15px;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .logout-btn:hover {
            background-color: #c0392b;
        }
        
        .content {
            padding: 30px;
        }
        
        .welcome-message {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .welcome-message h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
        }
        
        .welcome-message p {
            font-size: 18px;
            color: #666;
        }
        
        .unlock-icon {
            font-size: 80px;
            color: #27ae60;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <header class="header">
            <div class="logo"><?= APP_NAME ?></div>
            <div class="user-info">
                <div class="welcome">Bienvenido, <?= htmlspecialchars($user['username']) ?></div>
                <a href="index.php?controller=Auth&action=logout" class="logout-btn">Cerrar Sesión</a>
            </div>
        </header>
        
        <div class="content">
            <div class="unlock-icon">
                🔓
            </div>
            <div class="welcome-message">
                <h1>¡Acceso exitoso!</h1>
                <p>Has ingresado correctamente al sistema. El candado ha sido desbloqueado.</p>
            </div>
        </div>
    </div>
</body>
</html>