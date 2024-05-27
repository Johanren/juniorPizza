<?php

class modeloViews
{
    function enlacePagina($enlace)
    {
        if (
            $enlace == 'ingresar' ||
            $enlace == 'inicio' ||
            $enlace == 'productos' ||
            $enlace == 'promocion' ||
            $enlace == 'categoria' ||
            $enlace == 'medida' ||
            $enlace == 'perfil' ||
            $enlace == 'proeevedor' ||
            $enlace == 'facturaProeevedor' ||
            $enlace == 'usuario' ||
            $enlace == 'cliente' ||
            $enlace == 'salir' ||
            $enlace == 'local' ||
            $enlace == 'ingredientes' ||
            $enlace == 'ingrediente_Producto' ||
            $enlace == 'mesas' ||
            $enlace == 'pedido' ||
            $enlace == 'recordatorio' ||
            $enlace == 'cocina' ||
            $enlace == '404' ||
            $enlace == 'configuracion' ||
            $enlace == 'caja' ||
            $enlace == 'deudores' ||
            $enlace == 'venta_dia' ||
            $enlace == 'devoluciones' ||
            $enlace == 'nomina' ||
            $enlace == 'factura_pdf' ||
            $enlace == 'propina' ||
            $enlace == 'ayuda' ||
            $enlace == 'gastos'
        ) {
            $modulo = 'views/moduls/' . $enlace . '.php';
        } elseif ($enlace == 'agregarUsuario' || $enlace == 'eliminarUsuario') {
            $modulo = 'views/moduls/usuario.php';
        } elseif ($enlace == 'agregarCliente' || $enlace == 'eliminarCliente') {
            $modulo = 'views/moduls/cliente.php';
        } elseif ($enlace == 'loginFallido') {
            $modulo = 'views/moduls/ingresar.php';
        } elseif ($enlace == 'loginInactivo') {
            $modulo = 'views/moduls/ingresar.php';
        } elseif ($enlace == 'agregarLocal' || $enlace == 'eliminarLocal') {
            $modulo = 'views/moduls/local.php';
        } elseif ($enlace == 'agregarProeevedor') {
            $modulo = 'views/moduls/proeevedor.php';
        } elseif ($enlace == 'agregarCategoria') {
            $modulo = 'views/moduls/categoria.php';
        } elseif ($enlace == 'agregarMedida') {
            $modulo = 'views/moduls/medida.php';
        } elseif ($enlace == 'agregarIngrediente') {
            $modulo = 'views/moduls/ingredientes.php';
        } elseif ($enlace == 'agregarProducto') {
            $modulo = 'views/moduls/productos.php';
        } elseif ($enlace == 'agregarIngredienteProducto') {
            $modulo = 'views/moduls/ingrediente_Producto.php';
        } elseif ($enlace == 'agregarPromocion') {
            $modulo = 'views/moduls/promocion.php';
        } elseif ($enlace == 'agregarMesa' || $enlace == 'eliminarMesa') {
            $modulo = 'views/moduls/mesas.php';
        } elseif ($enlace == 'agregarPedidor') {
            $modulo = 'views/moduls/pedido.php';
        } elseif ($enlace == 'actualizoMesa') {
            $modulo = 'views/moduls/pedido.php';
        } elseif ($enlace == 'agregarNomina') {
            $modulo = 'views/moduls/nomina.php';
        } elseif ($enlace == 'actualizarUsuario') {
            $modulo = 'views/moduls/usuario.php';
        } elseif ($enlace == 'actualizarCliente') {
            $modulo = 'views/moduls/cliente.php';
        } elseif ($enlace == 'actualizarLocal') {
            $modulo = 'views/moduls/local.php';
        } elseif ($enlace == 'actualizarProeevedor') {
            $modulo = 'views/moduls/proeevedor.php';
        } elseif ($enlace == 'actualizarIngrediente') {
            $modulo = 'views/moduls/ingredientes.php';
        } elseif ($enlace == 'actualizarProducto') {
            $modulo = 'views/moduls/productos.php';
        } elseif ($enlace == 'actualizarCategoria') {
            $modulo = 'views/moduls/categoria.php';
        } elseif ($enlace == 'actualizarMedida') {
            $modulo = 'views/moduls/medida.php';
        } elseif ($enlace == 'actualizarPromocion') {
            $modulo = 'views/moduls/promocion.php';
        } elseif ($enlace == 'productoDevuelto') {
            $modulo = 'views/moduls/devoluciones.php';
        }elseif ($enlace == 'FacturaCancelada') {
            $modulo = 'views/moduls/devoluciones.php';
        }elseif ($enlace == 'agregarGasto' || $enlace == 'actualizarGasto' || $enlace == 'eliminarGasto') {
            $modulo = 'views/moduls/gastos.php';
        }else {
            $modulo = 'views/moduls/404.php';
        }
        return $modulo;

    }
}
