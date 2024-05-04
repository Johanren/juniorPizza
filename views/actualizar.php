<?php
require_once '../models/conexion.php';
require_once '../models/modeloFuncion.php';

foreach ($_POST as $nombre_campo => $valor) {
    // Verificar si el checkbox está marcado

    // Actualizar el estado en la base de datos
    $actualizar = new ModeloFuncion();
    $res = $actualizar->actualizarFuncion($valor, $nombre_campo);
}

