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

    function listarPropinaInicioFin(){
        if (isset($_POST['consultar'])) {
            $inicio = $_POST['inicio'];
            $fin = $_POST['fin'];
            $listar = new ModeloPropina();
            $res = $listar->listarPropinaInicioFinModelo($inicio, $fin);
            return $res;
        }
    }
}
