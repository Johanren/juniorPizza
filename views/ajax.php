<?php
//controlador
require_once '../controllers/controladorProeevedor.php';
require_once '../controllers/controladorMedida.php';
require_once '../controllers/controladorCategoria.php';
require_once '../controllers/controladorLocal.php';
require_once '../controllers/controladorProducto.php';
require_once '../controllers/controladorIngredientes.php';
//modelo
require_once '../models/modeloProeevedor.php';
require_once '../models/modeloMedida.php';
require_once '../models/modeloCategoria.php';
require_once '../models/modeloLocal.php';
require_once '../models/modeloProducto.php';
require_once '../models/modeloIngrediente.php';
class Ajax
{
    public $proeevedor;

    public $medida;
    public $categoria;
    public $local;
    public $producto;
    public $ingrediente;


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