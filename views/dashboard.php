<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login Seguro - Dashboard</title>
    <link rel="stylesheet" href="views/assets/css/style.css">

</head>
<body class="dashboard">
    <div class="dashboard-container">
        <!-- Barra lateral -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">Sistema de Login Seguro</div>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="#" class="nav-link" data-page="dashboard">
                            <i class="fas fa-tachometer-alt"></i><span> Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?controller=Report&action=index" class="nav-link" data-page="report">
                            <i class="fas fa-chart-bar"></i><span> Informe</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Contenido principal -->
        <div class="main-content">
            <header class="header">
                <div></div>
                <div class="user-info">
                    <div class="welcome">Bienvenido, <?= htmlspecialchars($user['username']) ?></div>
                    <a href="index.php?controller=Auth&action=logout" class="logout-btn">Cerrar Sesión</a>
                </div>
            </header>
            
            <div class="content">
                <div class="welcome-card">
                    <div class="logo-container">
                        <img src="imagenes/logo.png" alt="Logo" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22200%22 viewBox=%220 0 200 200%22><rect width=%22200%22 height=%22200%22 fill=%22%23f0f0f0%22 /><text x=%22100%22 y=%22100%22 font-size=%2220%22 text-anchor=%22middle%22 alignment-baseline=%22middle%22 fill=%22%23333%22>GovShield</text></svg>';">
                    </div>
                    <div class="unlock-icon">
                        <img src="imagenes/unlock.png" alt="Candado desbloqueado" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22 viewBox=%220 0 24 24%22><path fill=%22%23f7b731%22 d=%22M18 10H9V7c0-1.654 1.346-3 3-3s3 1.346 3 3h2c0-2.757-2.243-5-5-5S7 4.243 7 7v3H6a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2v-8a2 2 0 00-2-2zm-7 8a1 1 0 01-2 0v-4a1 1 0 012 0v4z%22/></svg>';" style="width: 80px; height: 80px;">
                    </div>
                    <div class="welcome-message">
                        <h1>¡Bienvenido!</h1>
                        <p>Has ingresado correctamente al sistema. Esta es la pantalla principal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funcionalidad para navegación
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                if(this.getAttribute('href') === '#') {
                    e.preventDefault();
                }
                
                // Quitar clase active de todos los enlaces
                document.querySelectorAll('.nav-link').forEach(el => {
                    el.classList.remove('active');
                });
                
                // Agregar clase active al enlace actual
                this.classList.add('active');
            });
        });
        
        // Marcar el enlace de Dashboard como activo por defecto
        document.querySelector('[data-page="dashboard"]').classList.add('active');
        
        // Función para ajustar el diseño responsive
        function adjustLayout() {
            const width = window.innerWidth;
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            
            if (width <= 576) {
                sidebar.style.position = 'relative';
                mainContent.style.marginLeft = '0';
                mainContent.style.width = '100%';
            } else {
                sidebar.style.position = 'fixed';
                if (width <= 768) {
                    sidebar.style.width = '70px';
                    mainContent.style.marginLeft = '70px';
                    mainContent.style.width = 'calc(100% - 70px)';
                } else if (width <= 992) {
                    sidebar.style.width = '200px';
                    mainContent.style.marginLeft = '200px';
                    mainContent.style.width = 'calc(100% - 200px)';
                } else {
                    sidebar.style.width = '250px';
                    mainContent.style.marginLeft = '250px';
                    mainContent.style.width = 'calc(100% - 250px)';
                }
            }
        }
        
        // Ajustar el diseño al cargar y al cambiar el tamaño de la ventana
        window.addEventListener('load', adjustLayout);
        window.addEventListener('resize', adjustLayout);
    </script>
</body>
</html>