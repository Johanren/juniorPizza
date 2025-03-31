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

    function consultarVentaDiaPosImprimir()
    {
        if (isset($_POST['consultar'])) {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDiaPosImprimir($_POST['buscar']);
            return $res;
        } else {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDiaPosImprimir('');
            return $res;
        }
    }

    function consultarVentaDiaFactura()
    {
        if (isset($_POST['consultar'])) {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDiaFactura($_POST['buscar']);
            return $res;
        } else {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDiaFactura('');
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

    function consultarVentaDiaCantidadTotalFactura($id_producto, $metodo)
    {
        if (isset($_POST['consultar'])) {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDiaCantidadTotalModeloFactura($id_producto, $_POST['buscar'], $metodo);
            return $res;
        } else {
            $buscar = new ModeloVenta();
            $res = $buscar->consultarVentaDiaCantidadTotalModeloFactura($id_producto, '', $metodo);
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

    function consultarFacturaDevolucionAjax($id)
    {
        $metodos = new ModeloVenta();
        $res = $metodos->consultarFacturaDevolucionAjaxModelo($id);
        return $res;
    }

    function realizarDevolucionCancelacion()
    {

        // Verifica si se está procesando una devolución de producto
        if (isset($_POST["id_factura"]) && isset($_POST["codigo_producto"]) && isset($_POST["cantidad_devuelta"])) {
            // Recupera los datos del formulario
            $id_factura = $_POST["id_factura"];
            $id = $_POST['id'];
            $codigos_productos = $_POST["codigo_producto"];
            $cantidades_devueltas = $_POST["cantidad_devuelta"];
            $cant = $_POST["cant"];
            $precio = $_POST["precio"];
            $total = $_POST["total"];
            $efectivo = $_POST["efectivo"];
            $totalDevolver = $cantidades_devueltas * $precio;
            $restarTotal = $total - $totalDevolver;
            $totalCan = $cant - $cantidades_devueltas;
            $efectivoTotal = $efectivo - $totalDevolver;
            $devolverProducto = new ModeloVenta();
            $resDevol = $devolverProducto->devolverProductoModelo($id, $id_factura, $restarTotal, $totalCan);
            if ($resDevol == true) {
                $devovlerFactura = new ControladorFactura();
                $resFac  = $devovlerFactura->restarEfectivoFactura($id_factura, $efectivoTotal);
                if ($resFac == true) {
                }
            }
        }

        // Verifica si se está procesando la cancelación de factura
        elseif (isset($_POST["cancelar_factura"]) && $_POST["cancelar_factura"] == "true") {
            // Recupera el número de factura a cancelar
            $id_factura = $_POST["id_factura"];

            $elimianrFactura = new ControladorFactura();
            $elim = $elimianrFactura->eliminarFactura($id_factura);
            if ($elim == true) {
                $eliminarVentaFac  = new ModeloVenta();
                $ventaElim = $eliminarVentaFac->eliminarFacturaVenta($id_factura);
                if ($ventaElim == true) {
                    echo '<script>window.location="FacturaCancelada"</script>';
                }
            }
        }
    }

    function informeVentaInicioFin()
    {
        if (isset($_POST['consultar'])) {
            $inicio = $_POST['inicio'];
            $fin = $_POST['fin'];
            $buscar = new ModeloVenta();
            $res = $buscar->informeVentaInicioFinModelo($inicio, $fin);
            return $res;
        }
    }

    function informeVentaInicioFinExcel($inicio, $fin)
    {
        $buscar = new ModeloVenta();
        $res = $buscar->informeVentaInicioFinModelo($inicio, $fin);
        return $res;
    }

    function informeVentainicioFinFactura($inicio, $fin){
        $buscar = new ModeloVenta();
        $res = $buscar->informeVentainicioFinFacturaModelo($inicio, $fin);
        return $res;
    }
}
