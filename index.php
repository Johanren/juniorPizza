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
require_once 'controllers/controladorPromocion.php';
require_once 'controllers/controladorMesa.php';
require_once 'controllers/controladorPiso.php';
require_once 'controllers/controladorPedido.php';
require_once 'controllers/controladorEvento.php';
require_once 'controllers/controladorSistema.php';
require_once 'controllers/controladorFuncion.php';
require_once 'controllers/controladorEstadoMesa.php';
require_once 'controllers/controladorFactura.php';
require_once 'controllers/controladorVenta.php';
require_once 'controllers/controladorNomina.php';
require_once 'controllers/controladorPropina.php';
require_once 'controllers/controladorAbrirCaja.php';
require_once 'controllers/controladorGasto.php';
require_once 'controllers/controladorObservacionFactura.php';
require_once 'controllers/controladorClienteTaller.php';
require_once 'controllers/controladorVehiculo.php';
require_once 'controllers/controladorEstadoVehiculo.php';
require_once 'controllers/controladorMateriales.php';
require_once 'controllers/controladorFirma.php';
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
require_once 'models/modeloPromocion.php';
require_once 'models/modeloMesa.php';
require_once 'models/modeloPiso.php';
require_once 'models/modeloPedido.php';
require_once 'models/modeloEvento.php';
require_once 'models/modeloSistema.php';
require_once 'models/modeloFuncion.php';
require_once 'models/modeloEstadoMesa.php';
require_once 'models/modeloFactura.php';
require_once 'models/modeloVenta.php';
require_once 'models/modeloNomina.php';
require_once 'models/modeloPropina.php';
require_once 'models/modeloGasto.php';
require_once 'models/modeloObservacionFactura.php';
require_once 'models/modeloClienteTaller.php';
require_once 'models/modeloVehiculo.php';
require_once 'models/modeloEstadoVehiculo.php';
require_once 'models/modeloMateriales.php';
require_once 'models/modeloFirma.php';
//fpdf


$views = new controladorViews();
$views->cargarTemplate();