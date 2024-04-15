<?php

class ControladorSistema{
    function listarConfiguracionSistema(){
        $listar = new ModeloSistema();
        $res = $listar->listarSistemaFuncionesModelo();
        return $res;
    }
}