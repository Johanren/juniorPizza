<?php

class modeloViews
{
    function enlacePagina($enlace)
    {
        if (
            $enlace == 'ingresar' ||
            $enlace == 'inicio' ||
            $enlace == 'productos' ||
            $enlace == 'agregarProductos' ||
            $enlace == 'promocion' ||
            $enlace == 'categoria' ||
            $enlace == 'medida' ||
            $enlace == 'perfil' ||
            $enlace == 'proeevedor' ||
            $enlace == 'facturaProeevedor' ||
            $enlace == 'usuario' ||
            $enlace == 'cliente' ||
            $enlace == 'salir' ||
            $enlace == 'local'
        ) {
            $modulo = 'views/moduls/' . $enlace . '.php';
        } elseif ($enlace == 'agregarUsuario') {
            $modulo = 'views/moduls/usuario.php';
        }elseif ($enlace == 'agregarCliente') {
            $modulo = 'views/moduls/cliente.php';
        }elseif ($enlace == 'loginFallido') {
            $modulo = 'views/moduls/ingresar.php';
        }elseif ($enlace == 'loginInactivo') {
            $modulo = 'views/moduls/ingresar.php';
        }elseif ($enlace == 'agregarLocal') {
            $modulo = 'views/moduls/local.php';
        }elseif ($enlace == 'agregarProeevedor') {
            $modulo = 'views/moduls/proeevedor.php';
        }
        return $modulo;

    }
}
