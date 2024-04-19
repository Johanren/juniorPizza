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

    function listarPedidoMesaFactura()
    {
        $listarid = new ModeloPedido();
        $res = $listarid->listarPedidoFacturaMesa();
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
            //$res = $actualizar->actualizarPedidoPrintModelo($id, $fecha, $print);
        } elseif (isset($_GET['estado'])) {
            $id = $_GET['estado'];
            $fecha = $_GET['fecha'];
            $cocina = 1;
            $actualizar = new ModeloPedido();
            $res = $actualizar->actualizarPedidoCocinaModelo($id, $fecha, $cocina);
            if ($res == true) {
                echo '<script>window.location="cocina"</script>';
            }
        }
    }

    function buscarMesaUsuarioId($id_mesa, $fecha)
    {
        $listar = new ModeloPedido();
        $res = $listar->listarMesaUsuarioIdModelo($id_mesa, $fecha);
        return $res;
    }

    function listarPedidoPrintAjaxControlador($print)
    {
        $listar = new ModeloPedido();
        $res = $listar->listarPedidoPrintAjaxModelo($print);
        if ($res) {
            $resListo = $listar->listarPedidoPirntFechaIngreso($res[0]['MAX(fecha_ingreso)'], $print);
            return $resListo;
        }
    }

    function listarPedidoPirntFechaUsuarioIngresoAjaxControlador($print)
    {
        $listar = new ModeloPedido();
        $res = $listar->listarPedidoPrintAjaxModelo($print);
        if ($res) {
            $resListo = $listar->listarPedidoPirntFechaUsuarioIngreso($res[0]['MAX(fecha_ingreso)'], $print);
            return $resListo;
        }
    }

    function ActualizarPedidoMesaAjaxControlador($print, $id)
    {
        $listar = new ModeloPedido();
        if ($id == 0) {
            $res = $listar->listarPedidoPrintAjaxModelo($print);
        } else {
            $res = $listar->listarPedidoPrintActAjaxModelo($print, $id);
        }
        if ($res) {
            $estadoMesa = 3;
            $printNuero = 1;
            $mesa = new ControladorMesa();
            $resFecha = $listar->listarPedidoPirntFechaUsuarioIngreso($res[0]['MAX(fecha_ingreso)'], $print);
            $actualizar = $mesa->actualizarEstadoMesa($resFecha[0]['id_mesa'], $estadoMesa);
            if ($actualizar) {
                $resListo = $listar->actualizarPedidoMesa($res[0]['MAX(fecha_ingreso)'], $print, $estadoMesa, $printNuero);
                return $resListo;
            }
        }
    }

    function listarPedidoFactura()
    {
        if (isset($_GET['id_mesa'])) {
            $listarid = new ModeloPedido();
            $res = $listarid->listarPedidoFacturaModelo($_GET['id_mesa']);
            return $res;
        }
    }

    function actualizarPagoPedido($id, $fecha)
    {
        $listarid = new ModeloPedido();
        $res = $listarid->actualizarPagoPedidoModelo($id, $fecha);
        return $res;
    }

}

