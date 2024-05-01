<?php
$listar = new ControladorUsuario();
$res = $listar->consultarUsuarioPerfil();
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="inicio">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Junior Pizza <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <?php
    if ($_SESSION['rol'] != "Administrador") {

    } else {
        ?>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?php if ($_GET['action'] == 'inicio') {
            print 'active';
        } ?>">
            <a class="nav-link" href="inicio">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Panel</span></a>
        </li>
        <?php
    }
    ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interfas
    </div>
    <?php
    if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Gerente") {

    } else {
        ?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item <?php if ($_GET['action'] == 'ingredientes' || $_GET['action'] == 'productos' || $_GET['action'] == 'ingrediente_Producto' || $_GET['action'] == 'promocion' || $_GET['action'] == 'categoria' || $_GET['action'] == 'medida') {
            print 'active';
        } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-utensils"></i>
                <span>Configurar Productos</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menú:</h6>
                    <a class="collapse-item" href="ingredientes">Ingredientes</a>
                    <a class="collapse-item" href="productos">Productos</a>
                    <a class="collapse-item" href="ingrediente_Producto">Productos & ingredientes</a>
                    <a class="collapse-item" href="promocion">Promociones</a>
                    <a class="collapse-item" href="categoria">Categoria</a>
                    <a class="collapse-item" href="medida">Medida</a>
                </div>
            </div>
        </li>
        <?php
    }
    ?>
    <?php
    if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Gerente") {

    } else {
        ?>
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item <?php if ($_GET['action'] == 'proeevedor' || $_GET['action'] == 'facturaProeevedor') {
            print 'active';
        } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-building"></i>
                <span>Proveedores</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="proeevedor">Proveedores</a>
                    <a class="collapse-item" href="facturaProeevedor">Factura Proeevedor</a>
                    <!--<a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>-->
                </div>
            </div>
        </li>
        <?php
    }
    ?>
    <?php
    if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Gerente") {

    } else {
        ?>
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item <?php if ($_GET['action'] == 'usuario' || $_GET['action'] == 'cliente' || $_GET['action'] == 'local') {
            print 'active';
        } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>
            <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="usuario">Usuario</a>
                    <a class="collapse-item" href="cliente">Cliente</a>
                    <?php if ($_SESSION['rol'] != "Administrador") {
                    } else { ?><a class="collapse-item" href="local">local</a>
                    <?php } ?>
                    <!--<a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>-->
                </div>
            </div>
        </li>
        <?php
    }
    ?>
    <?php
    if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Gerente" && $_SESSION['rol'] != "Mesero") {

    } else {
        ?>
        <li class="nav-item <?php if ($_GET['action'] == 'mesas' || $_GET['action'] == 'pedido') {
            print 'active';
        } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mesero" aria-expanded="true"
                aria-controls="collapseUtilities">
                <i class="fas fa-tablet-alt"></i>
                <span>Mesero</span>
            </a>
            <div id="mesero" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="mesas">Mesas</a>
                    <a class="collapse-item" href="pedido">Pedidos</a>
                    <!--<a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>-->
                </div>
            </div>
        </li>
        <?php
    }
    ?>
    <?php
    if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Gerente" && $_SESSION['rol'] != "Mesero" && $_SESSION['rol'] != "Cajero") {

    } else {
        ?>
        <li class="nav-item <?php if ($_GET['action'] == 'caja' || $_GET['action'] == 'nomina' || $_GET['action'] == 'propina' || $_GET['action'] == 'venta_dia' || $_GET['action'] == 'devoluciones' || $_GET['action'] == 'deudores') {
            print 'active';
        } ?>">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#facutracion" aria-expanded="true"
                aria-controls="collapseUtilities">
                <i class="fas fa-wallet"></i>
                <span>Facturación</span>
            </a>
            <div id="facutracion" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu:</h6>
                    <a class="collapse-item" href="caja">Caja</a>
                    <a class="collapse-item" href="venta_dia">Venta dia</a>
                    <a class="collapse-item" href="nomina">Nomina</a>
                    <a class="collapse-item" href="propina">Propina</a>
                    <!--<a class="collapse-item" href="devoluciones">Devoluciones</a>
                    <a class="collapse-item" href="deudores">Deudores</a>-->
                </div>
            </div>
        </li>
        <?php
    }
    ?>
    <?php
    if ($_SESSION['rol'] != "Administrador" && $_SESSION['rol'] != "Gerente" && $_SESSION['rol'] != "Cocina") {

    } else {
        ?>
        <li class="nav-item <?php if ($_GET['action'] == 'cocina') {
            print 'active';
        } ?>">
            <a class="nav-link" href="cocina">
                <i class="fas fa-store"></i>
                <span>Cocina</span></a>
        </li>
        <?php
    }
    ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if ($_GET['action'] == 'recordatorio') {
        print 'active';
    } ?>">
        <a class="nav-link" href="recordatorio">
            <i class="fas fa-calendar"></i>
            <span>Recordatorio</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <!--<div class="sidebar-heading">
        Addons
    </div>-->

    <!-- Nav Item - Pages Collapse Menu -->
    <!--<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>-->

    <!-- Nav Item - Charts -->
    <!--<li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>-->

    <!-- Nav Item - Tables -->
    <!--<li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>-->

    <!-- Divider -->
    <!--<hr class="sidebar-divider d-none d-md-block">-->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!--<div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="views/img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and
            more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div>-->

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                        aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <span class="badge badge-danger badge-counter">3+</span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Alerts Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 12, 2019</div>
                                <span class="font-weight-bold">A new monthly report is ready to download!</span>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 7, 2019</div>
                                $290.29 has been deposited into your account!
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="mr-3">
                                <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500">December 2, 2019</div>
                                Spending Alert: We've noticed unusually high spending for your account.
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <!-- Counter - Messages -->
                        <span class="badge badge-danger badge-counter">7</span>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Message Center
                        </h6>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="views/img/undraw_profile_1.svg" alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div class="font-weight-bold">
                                <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                    problem I've been having.</div>
                                <div class="small text-gray-500">Emily Fowler · 58m</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="views/img/undraw_profile_2.svg" alt="...">
                                <div class="status-indicator"></div>
                            </div>
                            <div>
                                <div class="text-truncate">I have the photos that you ordered last month, how
                                    would you like them sent to you?</div>
                                <div class="small text-gray-500">Jae Chun · 1d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="views/img/undraw_profile_3.svg" alt="...">
                                <div class="status-indicator bg-warning"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Last month's report looks great, I am very happy with
                                    the progress so far, keep up the good work!</div>
                                <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                            </div>
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <div class="dropdown-list-image mr-3">
                                <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                    alt="...">
                                <div class="status-indicator bg-success"></div>
                            </div>
                            <div>
                                <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                    told me that people say this to all dogs, even if they aren't good...</div>
                                <div class="small text-gray-500">Chicken the Dog · 2w</div>
                            </div>
                        </a>
                        <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <?php echo $res[0]['usuario'] ?>
                        </span>
                        <?php
                        if ($res[0]['foto'] != null) {
                            ?>
                            <img class="img-profile rounded-circle" src="<?php echo $res[0]['foto'] ?>">
                            <?php
                        } else {
                            ?>
                            <img class="img-profile rounded-circle" src="views/img/undraw_profile.svg">
                            <?php
                        }
                        ?>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="perfil">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Perfil
                        </a>
                        <a class="dropdown-item" href="configuracion">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Configuración
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Cerrar Sesión
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->