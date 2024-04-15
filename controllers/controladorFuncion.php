<?php

class ControladorFuncion
{
    function listarFunciones()
    {
        $listar = new ModeloFuncion();
        $res = $listar->listarFuncionModelo();
        if ($res) {
            foreach ($res as $key => $value) {
                $_SESSION[$value['nombre_campo']] = $value['estado'];
            }
            if ($_GET['action'] == "configuracion") {
                //print $_SESSION[$value['nombre_campo']];
            } else {
                header('location:inicio');
            }
        }
    }
}