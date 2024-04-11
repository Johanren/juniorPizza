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
			if (isset($_SESSION['validar'])) {
				$enlace = $_GET['action'];
			} else {
				$enlace = 'ingresar';
			}

		} else {
			if (isset($_SESSION['validar'])) {
				$enlace = 'inicio';
			} else {
				$enlace = 'ingresar';
			}
		}

        $pagina = new modeloViews();
        $respuesta = $pagina->enlacePagina($enlace);
        include ($respuesta);

    }
}