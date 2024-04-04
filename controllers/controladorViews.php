<?php

class controladorViews
{
    function cargarTemplate()
    {

        include 'views/template.php';

    }

    public function enlacesPaginaControlador()
    {
        if (isset($_GET['action'])) {
            $enlace = $_GET['action'];
        } else {
            $enlace = 'inicio';
        }

        $pagina = new modeloViews();
        $respuesta = $pagina->enlacePagina($enlace);
        include ($respuesta);

    }
}