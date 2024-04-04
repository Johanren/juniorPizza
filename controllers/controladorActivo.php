<?php

class ControladorActivo
{
    function listarActivo()
    {
        $listar = new ModeloActivo();
        $res = $listar->lsitarActivoModelo();
        return $res;
    }
}