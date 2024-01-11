<div class="leftside-menu">
    <!-- Logo -->
    <a href="http://localhost/inventario/index.php" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="https://quillota.cl/mantenedor/assets/images/logo.png" alt="" height="50">
        </span>
    </a>
    <!-- Fin Logo -->

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">


            <li class="side-nav-title side-nav-item">Funciones</li>

            <li class="side-nav-item">
                <a href="http://localhost/inventario/index.php" class="side-nav-link">
                    <i class="uil-comments-alt"></i>
                    <span> INICIO </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="http://localhost/inventario/views/MostrarProductosView.php" class="side-nav-link">
                    <i class="uil-comments-alt"></i>
                    <span> Inventario </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="http://localhost/inventario/views/AgregarCategoriasView.php" class="side-nav-link">
                    <i class="uil-comments-alt"></i>
                    <span> Categorías </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="http://localhost/inventario/views/LibroInventarioView.php" class="side-nav-link">
                    <i class="uil-comments-alt"></i>
                    <span> Historial </span>
                </a>
            </li>
            <li class="side-nav-item side-nav-link" style="position: absolute; bottom: 0; margin-bottom: 80px;">
                <i class="fa-regular fa-user"></i><?= $_SESSION['usuario'] ?>
            </li>
            <li class="side-nav-item" style="position: absolute; bottom: 0; margin-bottom: 40px;">
                <a class="side-nav-link" href="logout.php" style="color: #ff3f3f !important; font-weight: bold;"><i class="fa-solid fa-arrow-right-from-bracket"></i> Desconectar</a>
            </li>
        </ul>

        <!-- Fin Sidemenu -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->