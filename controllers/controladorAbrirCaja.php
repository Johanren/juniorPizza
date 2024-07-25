<?php

class ControladorAbrirCaja
{
    function abrirYCerrarCaja()
    {
        if (isset($_SESSION['rol'])) {
            if ($_SESSION['rol'] == "Cajero" || $_SESSION['rol'] == "Gerente" || $_SESSION['rol'] == "Administrador") {
                if (isset($_SESSION['caja'])) {
                    //include("views/moduls/aperturaCaja.php");
                } else {
                    include("views/moduls/aperturaCaja.php");
                    if (isset($_POST['monto'])) {
                        $dato = array(
                            'monto' => str_replace(',', '', $_POST['monto']),
                            'cierre' => "false"
                        );
                        $registrarApertura = new ModeloApertura();
                        $res = $registrarApertura->agregarApeturaModelo($dato);
                        if ($res == true) {
                            $consultarApertura = new ModeloApertura();
                            $resCon = $consultarApertura->consultarAperturaModelo();
                            echo '<script>window.location="venta_dia"</script>';
                            $fecha_actual = new DateTime();
                            $_SESSION['caja'] = [
                                'id_apertura' => $resCon[0]['id_apertura'],
                                'monto_inicial' => $resCon[0]['monto'],
                                'fecha_apertura' => $resCon[0]['fecha_apertura']
                            ];
                        }
                    } else {
                        print "<script>$(document).ready(function() {
                            $('#abrirCaja').modal('toggle')
                        });</script>";
                    }
                }
            }
        }
    }

    function cerrarCajaControlador()
    {
        if (isset($_SESSION['caja'])) {
            $fecha_actual = new DateTime();
            $dato = array(
                'id_apertura' => $_SESSION['caja']['id_apertura'],
                'fecha_cierre' => $fecha_actual->format('Y-m-d H:i:s'),
                'cierre' => "true"
            );
            $actu = new ModeloApertura();
            $res = $actu->cerrarCajaModelo($dato);
            if ($res == true) {
                unset($_SESSION['caja']);
                echo '<script>window.location</script>';
            }
        }
    }
}
