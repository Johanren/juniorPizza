<?php

class ControladorFacturaProeevedor
{
    function agregarFacturaProeevedor($id_categoria, $id_proeevedor, $id_usuario, $id_medida, $codigo, $nombre, $precio, $cantidad, $id_local, $totalFactura)
    {
        $agregar = new ModeloFacturaProeevedor();
        $res = $agregar->agregarFacturaModelo($id_categoria, $id_proeevedor, $id_usuario, $id_medida, $codigo, $nombre, $precio, $cantidad, $id_local, $totalFactura);
        return $res;
    }

    function listarProeevedorFactura()
    {
        if (isset($_POST['buscar'])) {
            $listar = new ModeloFacturaProeevedor();
            $res = $listar->listarProeevedorFacturaModelo($_POST['fecha']);
            return $res;
        } elseif (isset($_GET['fecha'])) {
            $listar = new ModeloFacturaProeevedor();
            $res = $listar->listarProeevedorFacturaModelo($_GET['fecha']);
            return $res;
        } else {
            $listar = new ModeloFacturaProeevedor();
            $res = $listar->listarProeevedorFacturaModelo('');
            return $res;
        }
    }

    function listarFacturaProducto()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $mostrar = new ModeloFacturaProeevedor();
            $res = $mostrar->listarFacturaProductoModelo($id, $_GET['fecha']);
            return $res;

        }
    }

    function DeudaProeevedor(){
        $sum = new ModeloFacturaProeevedor();
        $res = $sum->DeudaProeevedorModelo();
        return $res;
    }
}