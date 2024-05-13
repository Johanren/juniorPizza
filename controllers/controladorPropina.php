<?php

class ControladorPropina
{
    function agregarPropina($dato)
    {
        $gregar = new ModeloPropina();
        $res = $gregar->agregarPropinaModelo($dato);
        return $res;
    }

    function listarPropina($id)
    {
        $listar = new ModeloPropina();
        $res = $listar->listarPropinaModelo($id);
        return $res;
    }

    function listarPropinaInicioFin()
    {
        if (isset($_POST['consultar'])) {
            $inicio = $_POST['inicio'];
            $fin = $_POST['fin'];
            $listar = new ModeloPropina();
            $res = $listar->listarPropinaInicioFinModelo($inicio, $fin);
            return $res;
        }
    }

    function actualizarPropinaAjax($propina, $id)
    {
        $mostrarPropina = new ControladorPropina();
        $resPropina = $mostrarPropina->listarPropina($id);
        $restaPropina = $resPropina[0]['valor_propinas'] - $propina;
        $actualizar = new ModeloPropina();
        $res = $actualizar->actualizarPropinaAjaxModelo($propina, $id);
        if ($res == true) {
            $mostrarVenta = new ControladorVenta();
            $resVenta = $mostrarVenta->mostrarFacturaVenta($id);
            $totalsinpropina = $resVenta[0]['total_factura'] - $restaPropina;
            $factura = new ControladorFactura();
            $resTotal = $factura->actualizarTotalFacturaPropina($totalsinpropina, $id);
            return $resTotal;
        }
    }
}
