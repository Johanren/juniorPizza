<?php

class ControladorFacturaProeevedor{
    function agregarFacturaProeevedor($id_categoria, $id_proeevedor, $id_usuario, $id_medida, $codigo, $nombre, $precio, $cantidad, $id_local){
        $agregar = new ModeloFacturaProeevedor();
        $res = $agregar->agregarFacturaModelo($id_categoria, $id_proeevedor, $id_usuario, $id_medida, $codigo, $nombre, $precio, $cantidad, $id_local);
        return $res;
    }

    function listarProeevedorFactura(){
        $listar = new ModeloFacturaProeevedor();
        $res = $listar->listarProeevedorFacturaModelo();
        return $res;
    }

    function listarFacturaProducto(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $mostrar = new ModeloFacturaProeevedor();
            $res = $mostrar->listarFacturaProductoModelo($id);
            return $res;
        }
    }
}