<?php

class ControladorObservacionFactura{
    function agregarObservacionFactura($dato){
        $agregar = new ModeloObservacionFactura();
        $res = $agregar->agregarObservacionFacturaModelo($dato);
        return $res;
    }
    function listarObservacionFactura(){
        if (isset($_POST['consultar'])) {
            $listar = new ModeloObservacionFactura();
            $res = $listar->listarObservacionFacturaModelo($_POST['placa']);
            return $res;
        }
    }

    function listarObservacionFacturaId(){
        if (isset($_GET['id_factura'])) {
            $id = $_GET['id_factura'];
            $listar = new ModeloObservacionFactura();
            $res = $listar->listarObservacionFacturaIdModelo($id);
            return $res;
        }
    }
}