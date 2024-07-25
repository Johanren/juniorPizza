<?php

class ControladorFuncion
{
    function listarFunciones()
    {
        // Start session if it hasn't been started yet
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $listar = new ModeloFuncion();
        $res = $listar->listarFuncionModelo();
        if ($res) {
            foreach ($res as $key => $value) {
                $_SESSION[$value['nombre_campo']] = $value['estado'];
            }
            if (isset($_GET['action']) && $_GET['action'] == "configuracion") {
                // Uncomment this line if you want to print the session variable for debugging
                // print $_SESSION[$value['nombre_campo']];
            } else {
                // Check if headers have already been sent
                if (!headers_sent()) {
                    header('Location: inicio');
                    exit(); // It's a good practice to call exit after header redirection
                } else {
                    echo "<script type='text/javascript'>window.location.href = 'inicio';</script>";
                }
            }
        }
    }
}
