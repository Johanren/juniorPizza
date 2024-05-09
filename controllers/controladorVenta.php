<?php

class ControladorVenta
{
    function agregarVenta($dato)
    {
        $agregar = new ModeloVenta();
        $res = $agregar->agregarVentaModelo($dato);
        return $res;
    }

    function mostrarFacturaVenta($id)
    {
        $mostrar = new ModeloVenta();
        $res = $mostrar->mostrarFacturaVentaModelo($id);
        return $res;
    }

    function consultarVentaDia()
    {
        if (isset($_POST['consultar'])) {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDia($_POST['buscar']);
            return $res;
        } else {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDia('');
            return $res;
        }
    }

    function ventaTotalDia()
    {
        if (isset($_POST['consultar'])) {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaTotalDia($_POST['buscar']);
            return $res;
        } else {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaTotalDia('');
            return $res;
        }
    }

    function consultarVentaDiaCantidadTotal($id_producto, $metodo)
    {
        if (isset($_POST['consultar'])) {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDiaCantidadTotalModelo($id_producto, $_POST['buscar'], $metodo);
            return $res;
        } else {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDiaCantidadTotalModelo($id_producto, '', $metodo);
            return $res;
        }
    }

    function ganaciasMensualesVenta()
    {
        $ganancia = new ModeloVenta();
        $res = $ganancia->ganaciasMensualesVentaModelo();
        return $res;
    }

    function ganaciasAnualesVenta()
    {
        $ganancia = new ModeloVenta();
        $res = $ganancia->ganaciasAnualesVentaModelo();
        return $res;
    }

    function listarMetodosPago()
    {
        $metodos = new ModeloVenta();
        $res = $metodos->listarMetodosPagoModelo(null);
        return $res;
    }

    function metodosPagoTotal($metodo)
    {
        $metodos = new ModeloVenta();
        $res = $metodos->listarMetodosPagoModelo($metodo);
        return $res;
    }
}
