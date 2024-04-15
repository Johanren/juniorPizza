<?php

class ControladorPedido
{
    function agregarPedido()
    {
        if (isset($_POST['agregarPedido'])) {
            date_default_timezone_set('America/Mexico_City');
            $fechaActal = date('Y-m-d H:i:s');
            $id_mesa = $_GET['id'];
            $id_producto = $_POST['id_pedido'];
            $producto = $_POST['producto'];
            $descripcion = $_POST['descripcion'];
            $cantidad = $_POST['cantidad'];
            $id_esatdo = 2;
            $id_usuario = $_SESSION['id_usuario'];
            for ($i = 0; $i < count($id_producto); $i++) {
                $agregar = new ModeloPedido();
                $res = $agregar->agregarPedidoModelo($id_mesa, $id_producto[$i], $producto[$i], $descripcion[$i], $cantidad[$i], $id_esatdo, $id_usuario, $fechaActal);
                if ($res == true) {
                    $actualizar = new ControladorMesa();
                    $res = $actualizar->actualizarEstadoMesa($id_mesa, $id_esatdo);
                    if ($res == true) {
                        echo '<script>window.location="agregarPedidor"</script>';
                    }
                }
            }
        }
    }

    function listarPedidoMesa()
    {
        $listarid = new ModeloPedido();
        $res = $listarid->listarPedidoMesa();
        return $res;
    }

    function listarPedidoMesaDescripcion($id, $fecha)
    {
        $listarid = new ModeloPedido();
        $res = $listarid->listarPedidoMesaDescripcionModelo($id, $fecha);
        return $res;
    }

    function ListarMesaPedido()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $fechaActal = $fechaActal . "%";
        $listar = new ModeloPedido();
        $res = $listar->ListarMesaPedidoModelo($fechaActal);
        return $res;
    }

    function listarPedidoCocina($id, $fecha)
    {
        $listar = new ModeloPedido();
        $res = $listar->listarPedidoCocinaModelo($id, $fecha);
        return $res;
    }

    function listarPedidoCocinaPrint($id, $fecha)
    {
        header('Content-Type: text/html; charset=UTF-8');
        $listar = new ModeloPedido();
        $res = $listar->listarPedidoCocinaModelo($id, $fecha);
        return $res;
    }

    function actualizarPedidoPrint()
    {
        if (isset($_GET['id_mesa'])) {
            $id = $_GET['id_mesa'];
            $fecha = $_GET['fecha'];
            $print = 1;
            $actualizar = new ModeloPedido();
            $res = $actualizar->actualizarPedidoPrintModelo($id, $fecha, $print);
        }
    }

    function buscarMesaUsuarioId($id_mesa, $fecha)
    {
        $listar = new ModeloPedido();
        $res = $listar->listarMesaUsuarioIdModelo($id_mesa, $fecha);
        return $res;
    }
}

