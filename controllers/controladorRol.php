<?php

class ControladorRol
{
    function listarRol()
    {
        $listar = new ModeloRol();
        $res = $listar->listarRolModelo();
        return $res;
    }
}