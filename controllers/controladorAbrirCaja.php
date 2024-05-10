<?php

class ControladorAbrirCaja
{
    function abrirYCerrarCaja()
    {
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == "Cajero" || $_SESSION['rol'] == "Gerente" || $_SESSION['rol'] == "Administrador") {
                if (isset($_SESSION['caja'])) {
                    include("views/moduls/aperturaCaja.php");
                } else {
                    include("views/moduls/aperturaCaja.php");
                    print "<script>$(document).ready(function() {
                            $('#abrirCaja').modal('toggle')
                        });</script>";
                    if (isset($_POST['abrir'])) {
                        $_SESSION['caja'] = [
                            'monto_inicial' => $pago = str_replace(',', '', $_POST['monto']),
                            'fecha_apertura' => $_POST['fecha']
                        ];
                        echo '<script>window.location</script>';
                    }
                }
            }
        }
    }
}
