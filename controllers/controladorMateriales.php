<?php

class ControladorMateriales
{
    function agregarMaterialesOrdenTrabajo($dato)
    {
        $agregar = new ModeloMateriales();
        $res = $agregar->agregarMaterialesOrdenTrabajoModelo($dato);
        return $res;
    }

    function listarMaterialesId()
    {
        $listar = new ModeloMateriales();
        $res = $listar->listarMaterialesIdModelo($_GET['id_cliente_taller']);
        return $res;
    }

    function actualizarMaterialesOrdenTrabajo($dato)
    {
        $actualizar = new ModeloMateriales();
        $res = $actualizar->actualizarMaterialesOrdenTrabajoModelo($dato);
        return $res;
    }
}
