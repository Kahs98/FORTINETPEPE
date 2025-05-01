<?php
// views/dashboard.php
$page = $_GET['page'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login Seguro - Dashboard</title>
    <link rel="icon" href="imagenes/logo.png" type="image/png">

    <!-- CSS principal -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?= time() ?>">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
          crossorigin="anonymous"
          referrerpolicy="no-referrer" />
</head>

<body class="dashboard <?= $page === 'dashboardglobal' ? 'dashboard-dsh' : '' ?>">
    <div class="dashboard-container">
        <!-- Barra lateral -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-brand">Sistema de Login Seguro</h2>
            </div>
            <nav class="sidebar-menu">
                <ul>
                    <li>
                        <a href="index.php?controller=Dashboard&action=index&page=dashboardglobal"
                           class="nav-link <?= $page === 'dashboardglobal' ? 'active' : '' ?>">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?controller=Dashboard&action=index&page=reporte"
                           class="nav-link <?= $page === 'reporte' ? 'active' : '' ?>">
                            <i class="fas fa-chart-bar"></i>
                            <span>Informe</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        
        <!-- Contenido principal -->
        <main class="main-content">
            <header class="header">
                <button class="toggle-sidebar" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="user-info">
                    <div class="welcome">
                        Bienvenido, <?= isset($user['username']) ? htmlspecialchars($user['username']) : 'Usuario' ?>
                    </div>
                    <a href="index.php?controller=Auth&action=logout" class="logout-btn">Cerrar Sesión</a>
                </div>
            </header>

            <section class="content">
                <?php
                // Incluimos la vista correspondiente si existe
                $allowed = ['dashboardglobal', 'reporte'];
                $viewFile = __DIR__ . "/{$page}.php";

                if (in_array($page, $allowed) && file_exists($viewFile)) {
                    include $viewFile;  // carga dashboardglobal.php o reporte.php
                } else {
                    // Vista de bienvenida por defecto
                ?>
                    <div class="welcome-card">
                        <div class="logo-container">
                            <img src="imagenes/logo.png" alt="Logo">
                        </div>
                        <div class="welcome-message">
                            <h1>¡Bienvenido!</h1>
                            <p>Has ingresado correctamente al sistema. Esta es la pantalla principal.</p>
                        </div>
                    </div>
                <?php
                }
                ?>
            </section>
        </main>
    </div>

    <script>
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

        window.addEventListener('load', adjustLayout);
        window.addEventListener('resize', adjustLayout);

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');
            sidebar.classList.toggle('minimized');
            mainContent.classList.toggle('expanded');
        }
    </script>

    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <!-- Cargar dashboard.js sólo en la vista dashboardglobal -->
    <?php if ($page === 'dashboardglobal'): ?>
        <script src="assets/js/dashboard.js?v=<?= time() ?>"></script>
    <?php endif; ?>
</body>
</html>
