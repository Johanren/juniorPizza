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
                    if (isset($_POST['monto'])) {
                        echo '<script>window.location="venta_dia"</script>';
                        print "hola";
                        $fecha_actual = new DateTime();
                        $_SESSION['caja'] = [
                            'monto_inicial' => $pago = str_replace(',', '', $_POST['monto']),
                            'fecha_apertura' => $fecha_actual->format('Y-m-d H:i:s')
                        ];
                    } else {
                        print "<script>$(document).ready(function() {
                            $('#abrirCaja').modal('toggle')
                        });</script>";
                    }
                }
            }
        }
    }
}
