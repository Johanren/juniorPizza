<?php

class ControladorVehiculo
{
    function agregarVehiculoOrdenTrabajo($dato)
    {
        $agregar = new ModeloVehiculo();
        $res = $agregar->agregarVehiculoOrdenTrabajoModelo($dato);
        return $res;
    }

    function listarOrdenTrabajoPlaca()
    {
        if (isset($_POST['consultar'])) {
            $listar = new ModeloVehiculo();
            $res = $listar->listarOrdenTrabajoPlacaModelo($_POST['placa']);
            return $res;
        }
    }

    function listarOrdenTrabajoPlacaId()
    {
        if (isset($_GET['id_cliente_taller'])) {
            $listar = new ModeloVehiculo();
            $res = $listar->listarOrdenTrabajoPlacaIdModelo($_GET['id_cliente_taller']);
            return $res;
        }
    }

    function actualizarVehiculoOrdenTrabajo($dato)
    {
        $actualizar = new ModeloVehiculo();
        $res = $actualizar->actualizarVehiculoOrdenTrabajoModelo($dato);
        return $res;
    }
}
