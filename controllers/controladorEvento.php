<?php

class ControladorEvento
{
    function consultarEventoVentanaControlador()
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActal = date('Y-m-d');
        $horaActual = date('h:i');
        $evento = new ModeloEvento();
        $res = $evento->consultarEventoModelo($fechaActal);
        $re = $evento->consultarEventoModelo($fechaActal);
        return $res;
        //echo $horaActual;
        foreach ($re as $key => $value) {
            $matriz = explode(" ", $value['start']);
            //echo $horaActual;
            $hoa = strtotime('-5 minute', strtotime($matriz[1]));
            $nueva = date('h:i', $hoa);
            if ($nueva == $horaActual) {
                print '
            <div class="toast">
				<p>Tienes agenda para hoy</p>
                <p>Evento: ' . $value['title'] . '</p>
                <p>Fecha y Hora: ' . $value['start'] . '</p>
                <p>Descripcion: ' . $value['descripcion'] . '</p>
			</div>
            
            ';
            }
        }
    }
}