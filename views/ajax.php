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
                'precio' => $value['precio_unitario'],
                'codigo' => $value['codigo_producto']
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
                'medida' => $value['nombre_medida']
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
        $respe = $resPedido->ActualizarPedidoMesaAjaxControlador($this->respuestaPrint);
        print $respe;
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

if (isset($_GET['respuestaPrint'])) {
    $ajax->respuestaPrint = $_GET['respuestaPrint'];
    $ajax->ActualizarPedidoMesa();
}