<?php

class ControladorEstadoMesa{
    function listarEstadoMesa(){
        $list =  new ModeloEstadoMesa();
        $res = $list->listarEstadoMesaModleo();
        return $res;
    }
}