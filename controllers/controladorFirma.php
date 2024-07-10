<?php

class ControladorFirma
{
    function agregarFirmaOrdenTrabajo($dato)
    {
        $agregar = new ModeloFirma();
        $res = $agregar->agregarFirmaOrdenTrabajoModelo($dato);
        return $res;
    }

    function actualizarFirmaOrdenTrabajo($dato)
    {
        $actualizar = new ModeloFirma();
        $res = $actualizar->actualizarFirmaOrdenTrabajoModelo($dato);
        return $res;
    }
}
