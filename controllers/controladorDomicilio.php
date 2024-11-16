<?php

class ControladorDomicilio
{
    function agregarDomicilio($dato)
    {
        $agregar = new ModeloDomicilio();
        $res = $agregar->agregarDomicilioModelo($dato);
        return $res;
    }

    function listarPedido()
    {
        $listar = new ModeloDomicilio();
        $res = $listar->listarDomicilioPedido($_GET['domicilio']);
        return $res;
    }

    function cancelarPedidoDomicilio($id)
    {
        $cancelado = 1;
        $actualziar = new ModeloDomicilio();
        $res = $actualziar->cancelarPedidoDomicilioModelo($cancelado, $id);
        if ($res == true) {
            echo '<script>window.location="pedidoCancelado"</script>';
        }
    }

    function listarPedidoTabla($id_domicilio)
    {
        $lsitar = new ModeloDomicilio();
        $res = $lsitar->listarPedidoTablaModelo($id_domicilio);
        return $res;
    }

    function listarPedidoDomicilioPrintAjaxControlador($print)
    {
        $listar = new ModeloDomicilio();
        $res = $listar->listarPedidoDomicilioPrintAjaxModelo($print);
        if ($res) {
            $resListo = $listar->listarPedidoDomicilioPirntFechaIngreso($res[0]['MAX(id_domicilio_pedido)'], $print);
            return $resListo;
        }
    }

    function ActualizarPedidoDomicilioAjaxControlador($print, $id)
    {
        date_default_timezone_set('America/Bogota');

        $hora = new DateTime();
        $timeFormatted = $hora->format('H:i:s');
        $estado = 3;
        $printDomicilio = 2;
        $listar = new ModeloDomicilio();
        $res = $listar->ActualizarPedidoDomicilioAjaxModelo($estado, $printDomicilio, $timeFormatted, $print, $id);
        return $res;
    }

    function listarDomicilioFactura()
    {
        $listar = new ModeloDomicilio();
        $res = $listar->listarDomicilioFacturaModelo();
        return $res;
    }

    function listarPedidoDomicilioFactura()
    {
        if (isset($_GET['id_domicilio'])) {
            $listarid = new ModeloDomicilio();
            $res = $listarid->listarPedidoDomicilioFacturaModelo($_GET['id_domicilio']);
            return $res;
        }
    }

    function actualizarPagoPedidoDomicilio($id, $fecha)
    {
        $listarid = new ModeloDomicilio();
        $res = $listarid->actualizarPagoPedidoDomicilioModelo($id, $fecha);
        return $res;
    }
}
