<?php

class ControladorPiso{
    function listarPiso(){
        $listar = new ModeloPiso();
        $res = $listar->listarPisoModelo();
        return $res;
    }
}