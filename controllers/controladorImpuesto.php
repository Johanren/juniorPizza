<?php

class ControladorImpuesto{
    function listarImpuestoAjaxControlador($impuesto){
        $listar = new ModeloImpuesto();
        $res = $listar->listarAjaxImpuestoModelo($impuesto);
        return $res;
    }

    function listarImpuesoControlador($dato){
        $listar = new ModeloImpuesto();
        $res = $listar->listarImpuesoModelo($dato);
        return $res;
    }
}