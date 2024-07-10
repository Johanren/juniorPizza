<?php

class ControladorEstadoVehiculo
{
    function agregarEstadoVehiculoOrdenTrabajo($dato)
    {
        $agregar = new ModeloEstadoVehiculo();
        $res = $agregar->agregarEstadoVehiculoOrdenTrabajoModelo($dato);
        return $res;
    }

    function actualizarEstadoVehiculoOrdenTrabajo($dato)
    {
        $actualizaqr = new ModeloEstadoVehiculo();
        $res = $actualizaqr->actualizarEstadoVehiculoOrdenTrabajoModelo($dato);
        return $res;
    }
}
