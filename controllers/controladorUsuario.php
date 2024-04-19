<?php

class ControladorUsuario
{
    function loginControlador()
    {
        if (isset($_POST['login'])) {
            $dato = array(
                'user' => $_POST['user'],
                'clave' => $_POST['clave']
            );
            $consultarUsuario = new ModeloUsuario();
            $res = $consultarUsuario->ModeloLoginIngresar($dato);
            if ($res[0]['nombre_activo'] != 'Inactivo') {
                if ($res[0]['usuario'] == $_POST['user'] && $res[0]['clave'] == $_POST['clave']) {
                    session_start();
                    $_SESSION['id_usuario'] = $res[0]['id_usuario'];
                    $_SESSION['id_local'] = $res[0]['id_local'];
                    $_SESSION['usuario'] = $res[0]['usuario'];
                    $_SESSION['rol'] = $res[0]['nombre_rol'];
                    $_SESSION['validar'] = true;
                    $funcion = new ControladorFuncion();
                    $funcion->listarFunciones();
                } else {
                    header('location:loginFallido');
                }
            } else {
                header('location:loginInactivo');
            }
        }
    }

    function agregarUsuario()
    {
        if (isset($_POST['agregarUsuario'])) {
            if ($_SESSION['rol'] == "Administrador") {
                $dato = array(
                    'priNombre' => $_POST['priNombre'],
                    'segNombre' => $_POST['segNombre'],
                    'priApellido' => $_POST['priApellido'],
                    'segApellido' => $_POST['segApellido'],
                    'user' => $_POST['user'],
                    'clave' => $_POST['clave'],
                    'rol' => $_POST['rol'],
                    'activo' => $_POST['activo'],
                    'local' => $_POST['local']
                );
            }else{
                $dato = array(
                    'priNombre' => $_POST['priNombre'],
                    'segNombre' => $_POST['segNombre'],
                    'priApellido' => $_POST['priApellido'],
                    'segApellido' => $_POST['segApellido'],
                    'user' => $_POST['user'],
                    'clave' => $_POST['clave'],
                    'rol' => $_POST['rol'],
                    'activo' => $_POST['activo'],
                    'local' => $_SESSION['id_local']
                ); 
            }

            $agregar = new ModeloUsuario();
            $res = $agregar->agregarUsuarioModelo($dato);
            if ($res == true) {
                echo '<script>window.location="agregarUsuario"</script>';
            }
        }
    }

    function listarUsuario()
    {
        $listar = new ModeloUsuario();
        $res = $listar->listarModeloUsuario();
        return $res;
    }

    function consultarUsuarioPerfil(){
        $listar = new ModeloUsuario();
        $res = $listar->consultarUsuarioPerfilModelo($_SESSION['id_usuario']);
        return $res;
    }

    function listarUsuarioNomina(){
        $listar = new ModeloUsuario();
        $res = $listar->listarUsuarioNominaModelo();
        return $res;
    }

    function listarUsuarioId(){
        $id = $_GET['id_usuario'];
        $listar = new ModeloUsuario();
        $res = $listar->listarUsuarioIdModelo($id);
        return $res;
    }
}