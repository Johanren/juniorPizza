<?php

class ControladorFuncion{
    function listarFunciones(){
        $listar = new ModeloFuncion();
        $res = $listar->listarFuncionModelo();
        if ($res) {
            foreach ($res as $key => $value) {
                $_SESSION[$value['nombre_campo']] = $value['estado'];
            }
            header('location:inicio');
        }
    }
}