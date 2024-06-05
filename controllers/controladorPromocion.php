<?php

class ControladorPromocion
{
    function agregarPromocion()
    {
        if (isset($_POST['agregarPromocion'])) {
            $id_producto = $_POST['id_producto'];
            $id_prodcu = $_POST['id_prodcu'];
            $cantidadPromocion = $_POST['cantidadPromocion'];
            $id_activa = 1;
            for ($i = 0; $i < count($id_prodcu); $i++) {
                $agregar = new ModeloPromocion();
                $res = $agregar->agregarPromocionModelo($id_producto, $id_prodcu[$i], $cantidadPromocion[$i], $id_activa);
                if ($res == true) {
                    echo '<script>window.location="agregarPromocion"</script>';
                }
            }
        } elseif (isset($_POST['actualizarIngredienteProducto'])) {
            $id = $_POST['id'];
            $id_producto = $_POST['id_producto'];
            $id_prodcu = $_POST['id_prodcuEdit'];
            $cantidadPromocion = $_POST['cantidadPromocionEdit'];
            $id_activa = $_POST['activoEdit'];
            for ($i = 0; $i < count($id); $i++) {
                $agregar = new ModeloPromocion();
                $res = $agregar->actualizarPromocionModelo($id[$i], $id_producto, $id_prodcu[$i], $cantidadPromocion[$i], $id_activa[$i]);
                if ($res == true) {
                    echo '<script>window.location="actualizarPromocion"</script>';
                }
            }
        }
    }

    function listarPromocionId()
    {
        $listar = new ModeloPromocion();
        $res = $listar->listarPromocionId();
        return $res;
    }

    function listarPromocion($id)
    {
        $consultar = new ModeloPromocion();
        $res = $consultar->listarPromocionModelo($id);
        return $res;
    }

    function listarPromocionProductoFactura($id)
    {
        $consul = new ModeloPromocion();
        $res = $consul->listarPromocionProductoFacturaModelo($id);
        return $res;
    }

    function eliminarPromocionId()
    {
        $id = $_GET['ids'];
        $listar = new ModeloPromocion();
        $res = $listar->eliminarPromocionIdModelo($id);
        if ($res == true) {
            echo '<script>window.location="eliminarPromocion"</script>';
        }
    }
}
