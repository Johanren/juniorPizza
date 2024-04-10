<?php  

//controllers
require_once 'controllers/controladorViews.php';
require_once 'controllers/controladorUsuario.php';
require_once 'controllers/controladorRol.php';
require_once 'controllers/controladorActivo.php';
require_once 'controllers/controladorCliente.php';
require_once 'controllers/controladorLocal.php';
require_once 'controllers/controladorProeevedor.php';
require_once 'controllers/controladorCategoria.php';
require_once 'controllers/controladorMedida.php';
require_once 'controllers/controladorIngredientes.php';
require_once 'controllers/controladorProducto.php';
require_once 'controllers/controladorFacturaProeevedor.php';
require_once 'controllers/controladorIngredienteProducto.php';
//Modelo
require_once 'Models/conexion.php';
require_once 'Models/modeloViews.php';
require_once 'Models/modeloActivo.php';
require_once 'Models/modeloRol.php';
require_once 'Models/modeloUsuario.php';
require_once 'models/modeloCliente.php';
require_once 'models/modeloLocal.php';
require_once 'models/modeloProeevedor.php';
require_once 'models/modeloCategoria.php';
require_once 'models/modeloMedida.php';
require_once 'models/modeloIngrediente.php';
require_once 'models/modeloProducto.php';
require_once 'models/modeloFacturaProeevedor.php';
require_once 'models/modeloIngredienteProducto.php';
//fpdf


$views = new controladorViews();
$views->cargarTemplate();