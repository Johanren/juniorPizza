<?php
//controlador
require_once '../controllers/controladorProeevedor.php';
require_once '../controllers/controladorMedida.php';
require_once '../controllers/controladorCategoria.php';
require_once '../controllers/controladorLocal.php';
require_once '../controllers/controladorProducto.php';
require_once '../controllers/controladorIngredientes.php';
require_once '../controllers/controladorIngredienteProducto.php';
require_once '../controllers/controladorPedido.php';
require_once '../controllers/controladorMesa.php';
require_once '../controllers/controladorCliente.php';
require_once '../controllers/controladorNomina.php';
require_once '../controllers/controladorVenta.php';
//modelo
require_once '../models/modeloProeevedor.php';
require_once '../models/modeloMedida.php';
require_once '../models/modeloCategoria.php';
require_once '../models/modeloLocal.php';
require_once '../models/modeloProducto.php';
require_once '../models/modeloIngrediente.php';
require_once '../models/modeloIngredienteProducto.php';
require_once '../models/modeloPedido.php';
require_once '../models/modeloMesa.php';
require_once '../models/modeloCliente.php';
require_once '../models/modeloNomina.php';
require_once '../models/modeloVenta.php';

class Ajax
{
    public $proeevedor;

    public $medida;
    public $categoria;
    public $local;
    public $producto;
    public $ingrediente;
    public $productoPedido;
    public $id_mesa;
    public $fecha;
    public $print;
    public $printUsuario;

    public $respuestaPrint;
    public $cc;
    public $articulo;
    public $idArticulo;
    public $id_nomina;
    public $factura;

    function consultarProeevedorAjax()
    {
        $consultar = new ControladorProeevedor();
        $respuesta = $consultar->consultarProeevedorAjaxControlador($this->proeevedor);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_proeevedor'],
                'id' => $value['id_proeevedor'],
                'nom' => $value['nombre_proeevedor'],
                'nit' => $value['nit_proeevedor'],
                'tel' => $value['telefono_proeevedor'],
                'dire' => $value['direccion_proeevedor'],
            );
        }

        print json_encode($datos);
    }

    function consultarMedidaAjax()
    {
        $consultar = new ControladorMedida();
        $respuesta = $consultar->consultarMedidaAjaxControlador($this->medida);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_medida'],
                'id' => $value['id_medida'],
            );
        }

        print json_encode($datos);
    }

    function consultarCategoriaAjax()
    {
        $consultar = new ControladorCategoria();
        $respuesta = $consultar->consultarCategoriaAjaxControlador($this->categoria);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_categoria'],
                'id' => $value['id_categoria'],
            );
        }

        print json_encode($datos);
    }

    function consultarLocalAjax()
    {
        $consultar = new ControladorLocal();
        $respuesta = $consultar->consultarLocalAjaxControlador($this->local);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_local'],
                'id' => $value['id_local'],
            );
        }

        print json_encode($datos);
    }

    function consultarProductoAjax()
    {
        $consultar = new ControladorProducto();
        $respuesta = $consultar->consultarProductoAjaxControlador($this->producto);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_producto'],
                'id' => $value['id_producto'],
                'precio' => number_format($value['precio_unitario'],0),
                'codigo' => $value['codigo_producto'],
                'cantidad' => $value['cantidad_producto'],
                'id_categoria' => $value['id_categoria'],
                'nombre_categoria' => $value['nombre_categoria'],
                'id_medida' => $value['id_medida'],
                'nombre_medida' => $value['nombre_medida'],
                'id_local' => $value['id_local'],
                'nombre_local' => $value['nombre_local']
            );
        }

        print json_encode($datos);
    }

    function consultarIngredienteAjax()
    {
        $consultar = new ControladorIngredientes();
        $respuesta = $consultar->consultarIngredeinteAjaxControlador($this->ingrediente);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_ingrediente'],
                'id' => $value['id_ingrediente'],
                'medida' => $value['nombre_medida'],
                'id_medida' => $value['id_medida'],
                'local' => $value['nombre_local'],
                'id_local' => $value['id_local'],
                'cantidad' => $value['cantidad']
            );
        }

        print json_encode($datos);
    }

    function consultarproductoPedidoAjax()
    {
        $consultar = new ControladorIngredienteProducto();
        $respuesta = $consultar->consultarIngredeinteAjaxControlador($this->productoPedido);
        foreach ($respuesta as $key => $value) {
            $datos[] = array(
                'label' => $value['nombre_producto'],
                'id' => $value['id_producto'],
                'descripcion' => (isset($value["GROUP_CONCAT(nombre_ingrediente SEPARATOR ', ')"])) ? $value["GROUP_CONCAT(nombre_ingrediente SEPARATOR ', ')"] : null
            );
        }

        print json_encode($datos);
    }

    function consultarPedidoPrintAjax()
    {
        $resPedido = new ControladorPedido();
        $respe = $resPedido->listarPedidoCocinaPrint($this->id_mesa, $this->fecha);
        foreach ($respe as $key => $value) {
            $datos[] = array('nombre' => $value['producto'], 'cantidad' => $value['cantidad'], 'descripcion' => (isset($value['descripcion'])) ? $value['descripcion'] : " ");
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function consultarMesaPrintAjax()
    {
        $resPedido = new ControladorPedido();
        $respe = $resPedido->buscarMesaUsuarioId($this->id_mesa, $this->fecha);
        foreach ($respe as $key => $value) {
            $datos[] = array('nombre' => $value['primer_nombre'], 'apellido' => $value['primer_apellido'], 'mesa' => $value['nombre_mesa']);
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function listarPedidoPrintAjax()
    {
        $resPedido = new ControladorPedido();
        $respe = $resPedido->listarPedidoPrintAjaxControlador($this->print);
        foreach ($respe as $key => $value) {
            $datos[] = array('nombre' => $value['producto'], 'cantidad' => $value['cantidad'], 'descripcion' => (isset($value['descripcion'])) ? $value['descripcion'] : " ");
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function listarPedidoPrintUsurioAjax()
    {
        $resPedido = new ControladorPedido();
        $respe = $resPedido->listarPedidoPirntFechaUsuarioIngresoAjaxControlador($this->printUsuario);
        foreach ($respe as $key => $value) {
            $datos[] = array('nombre' => $value['primer_nombre'], 'apellido' => $value['primer_apellido'], 'mesa' => $value['nombre_mesa']);
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function ActualizarPedidoMesa()
    {
        $resPedido = new ControladorPedido();
        $respe = $resPedido->ActualizarPedidoMesaAjaxControlador($this->respuestaPrint, $this->id_mesa);
        print $respe;
    }

    function buscarClienteCC()
    {
        $consultar_cliente = new ControladorCLiente();
        $res = $consultar_cliente->consultarClienteAjax($this->cc);
        foreach ($res as $key => $value) {  
            $datos[] = array(
                'label1' => $value['numero_cc'],
                'label' => $value['primer_nombre'] . " " . $value['primer_apellido'],
                'id' => $value['id_cliente']
            );
        }

        print json_encode($datos);
    }

    function consultarAritucloProeevedorNombre()
    {
        $consultar_id = new ControladorProducto();
        $res = $consultar_id->consultarAritucloProeevedoridAjax($this->articulo);
        foreach ($res as $key => $value) {
            $datos[] = array(
                'value' => $value['id_producto'],
                'label' => $value['nombre_producto']
            );
        }

        print json_encode($datos);

    }

    function consultarAritucloProeevedor()
    {
        $consultar_id = new ControladorProducto();
        $res = $consultar_id->consultarAritucloProeevedorAjax($this->idArticulo);

        print json_encode($res);

    }

    function consultarNominaPedidoAjax()
    {
        $resPedido = new ControladorNomina();
        $respe = $resPedido->consultarNominaPedidoAjax($this->id_nomina);
        foreach ($respe as $key => $value) {
            $datos[] = array('nombre' => $value['nombre'] . " " . $value['apellido'], 'dias' => $value['dias_trabajados'], 'ValorTotal' => $value['pago'],);
        }
        header('Content-Type: text/html; charset=UTF-8');
        print json_encode($datos);
    }

    function consultarFacturaDevolucionAjax()
    {
        $factura = new ControladorVenta();
        $res = $factura->consultarFacturaDevolucionAjax($this->factura);
        foreach ($res as $key => $value) {
            $datos[] = array('label' => $value['nombre_producto'], 'label1' => $value['codigo_producto'], 'label2' => $value['cantidad'], 'precio' => $value['valor_unitario'], 'total' => $value['precio_compra'], 'id' => $value['id_producto'], 'efectivo' => $value['total_factura'], 'id_factura' => $value['id_factura']);
        }
        print json_encode($datos);
    }
}

$ajax = new Ajax();

if (isset($_GET['proeevedor'])) {
    $ajax->proeevedor = $_GET['proeevedor'];
    $ajax->consultarProeevedorAjax();
}

if (isset($_GET['medida'])) {
    $ajax->medida = $_GET['medida'];
    $ajax->consultarMedidaAjax();
}

if (isset($_GET['categoria'])) {
    $ajax->categoria = $_GET['categoria'];
    $ajax->consultarCategoriaAjax();
}

if (isset($_GET['local'])) {
    $ajax->local = $_GET['local'];
    $ajax->consultarLocalAjax();
}

if (isset($_GET['producto'])) {
    $ajax->producto = $_GET['producto'];
    $ajax->consultarProductoAjax();
}

if (isset($_GET['ingrediente'])) {
    $ajax->ingrediente = $_GET['ingrediente'];
    $ajax->consultarIngredienteAjax();
}

if (isset($_GET['productoPedido'])) {
    $ajax->productoPedido = $_GET['productoPedido'];
    $ajax->consultarproductoPedidoAjax();
}

if (isset($_GET['id_mesa']) && isset($_GET['fecha'])) {
    $ajax->id_mesa = $_GET['id_mesa'];
    $ajax->fecha = $_GET['fecha'];
    $ajax->consultarPedidoPrintAjax();
}

if (isset($_GET['id_mesa']) && isset($_GET['fechaActual'])) {
    $ajax->id_mesa = $_GET['id_mesa'];
    $ajax->fecha = $_GET['fechaActual'];
    $ajax->consultarMesaPrintAjax();
}

if (isset($_GET['print'])) {
    $ajax->print = $_GET['print'];
    $ajax->listarPedidoPrintAjax();
}

if (isset($_GET['printUsuario'])) {
    $ajax->printUsuario = $_GET['printUsuario'];
    $ajax->listarPedidoPrintUsurioAjax();
}

if (isset($_GET['respuestaPrint']) && isset($_GET['id'])) {
    $ajax->respuestaPrint = $_GET['respuestaPrint'];
    $ajax->id_mesa = $_GET['id'];
    $ajax->ActualizarPedidoMesa();
}

if (isset($_GET['cc'])) {
    $ajax->cc = $_GET['cc'];
    $ajax->buscarClienteCC();
}

if (isset($_GET['nombre'])) {
    $ajax->articulo = $_GET['nombre'];
    $ajax->consultarAritucloProeevedorNombre();
}  

if (isset($_GET['id_nomina'])) {
    $ajax->id_nomina = $_GET['id_nomina'];
    $ajax->consultarNominaPedidoAjax();
}  

if (isset($_GET['factura'])) {
    $ajax->factura = $_GET['factura'];
    $ajax->consultarFacturaDevolucionAjax();
}  

$request = 0;
if (isset($_GET['request'])) {
    $request = $_GET['request'];
}
if ($request == 2) {
    $userid = 0;
    if (isset($_GET['userid'])) {
        $ajax->idArticulo = $_GET['userid'];
        $ajax->consultarAritucloProeevedor();
    }

}