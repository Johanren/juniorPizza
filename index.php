<?php  

//controllers
require_once 'controllers/controladorViews.php';
require_once 'controllers/controladorUsuario.php';
require_once 'controllers/controladorRol.php';
require_once 'controllers/controladorActivo.php';
require_once 'controllers/controladorCliente.php';
require_once 'controllers/controladorLocal.php';
require_once 'controllers/controladorProeevedor.php';
//Modelo
require_once 'Models/conexion.php';
require_once 'Models/modeloViews.php';
require_once 'Models/modeloActivo.php';
require_once 'Models/modeloRol.php';
require_once 'Models/modeloUsuario.php';
require_once 'models/modeloCliente.php';
require_once 'models/modeloLocal.php';
require_once 'models/modeloProeevedor.php';
//fpdf


$views = new controladorViews();
$views->cargarTemplate();