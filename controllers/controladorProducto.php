<?php

class ControladorProducto
{
    function agregarProducto()
    {
        if (isset($_POST['agregarProducto'])) {
            $id = $_POST['id_producto'];
            $id_proeevedor = $_POST['id_proeevedor'];
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $precio = str_replace(',', '', $_POST['precio']);
            $precioUnita = str_replace(',', '', $_POST['precioUnita']);
            $total = str_replace(',', '', $_POST['total']);
            $cantidad = $_POST['cantidad'];
            $cant = $_POST['cant'];
            $id_categoria = $_POST['id_categoria'];
            $id_medida = $_POST['id_medida'];
            $id_impuesto = ($_POST['id_impuesto'] > 0 ? $_POST['id_impuesto'] : 1);
            $totalFactura = str_replace(',', '', $_POST['totalFactura']);
            if ($_SESSION['rol'] == "Administrador") {
                $id_local = $_SESSION['id_local'];
                for ($i = 0; $i < count($codigo); $i++) {
                    if ($id[$i] != null) {
                        $cantidad_producto = $cant[$i] + $cantidad[$i];
                        $agreagr = new ModeloProducto();
                        $res = $agreagr->actualizarProductoModelo($id[$i], $id_proeevedor, $codigo[$i], $nombre[$i], $precio[$i], $cantidad_producto, $id_categoria[$i], $id_medida[$i], $id_impuesto[$i], $id_local);
                        if ($res == true) {
                            $agregarFactura = new ControladorFacturaProeevedor();
                            $resFactura = $agregarFactura->agregarFacturaProeevedor($id_categoria[$i], $id_proeevedor, $_SESSION['id_usuario'], $id_medida[$i], $codigo[$i], $nombre[$i], $precio[$i], $cantidad[$i], $id_local, $totalFactura, $precioUnita[$i], $total[$i]);
                            if ($resFactura == true) {
                                if (isset($_SESSION['envioCorreo'])) {
                                    if ($_SESSION['envioCorreo'] == 'true') {

                                        date_default_timezone_set('America/Mexico_City');
                                        $fechaActal = date('Y-m-d');
                                        $enviarCorreo = new ModeloFacturaProeevedor();
                                        $resEnvioCorreo = $enviarCorreo->listarFacturaProductoModelo($id_proeevedor, $fechaActal);
                                        $mostrar = new ModeloProeevedor();
                                        $enviarProe = $mostrar->consultarProeevedorModelo($id_proeevedor);
                                        $htmlContent = '<html>
                                    <head>
                                        <style>
                                            table {
                                                width: 100%;
                                                border-collapse: collapse;
                                            }
                                            th, td {
                                                border: 1px solid #ddd;
                                                padding: 8px;
                                            }
                                            th {
                                                background-color: #f4f4f4;
                                            }
                                            .table-responsive {
                                                overflow-x: auto;
                                            }
                                        </style>
                                    </head>
                                    <body>
                                        <div class="form-row mt-2" style="text-align: center;">
                                            <div class="form-group col-md-3"></div>
                                            <div class="form-group col-md-6">
                                                Proveedor: <span id="nom_proveedor">' . htmlspecialchars($enviarProe[0]['nombre_proeevedor']) . '</span><br>
                                                NIT: <span id="nit_proveedor">' . htmlspecialchars($enviarProe[0]['nit_proeevedor']) . '</span><br>
                                                Teléfono: <span id="tel_proveedor">' . htmlspecialchars($enviarProe[0]['telefono_proeevedor']) . '</span><br>
                                                Dirección: <span id="dir_proveedor">' . htmlspecialchars($enviarProe[0]['direccion_proeevedor']) . '</span>
                                            </div>
                                        </div>
                                        <div class="table-responsive mt-3">
                                            <table class="table mt-2" id="producto">
                                                <thead>
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Producto</th>
                                                        <th>Precio</th>
                                                        <th>Cantidad</th>
                                                        <th>Categoría</th>
                                                        <th>Medida</th>
                                                        <th>Precio Unitario</th>
                                                        <th>Costo * Prod</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                                        foreach ($resEnvioCorreo as $key => $value) {
                                            $htmlContent .= '<tr>
                                            <td>' . htmlspecialchars($value['codigo_producto']) . '</td>
                                            <td>' . htmlspecialchars($value['nombre_producto']) . '</td>
                                            <td>' . htmlspecialchars(number_format($value['precio_unitario'], 0)) . '</td>
                                            <td>' . htmlspecialchars($value['cantidad_producto']) . '</td>
                                            <td>' . htmlspecialchars($value['nombre_categoria']) . '</td>
                                            <td>' . htmlspecialchars($value['nombre_medida']) . '</td>
                                            <td>' . htmlspecialchars(number_format($value['unitario'], 0)) . '</td>
                                            <td>' . htmlspecialchars(number_format($value['total'], 0)) . '</td>
                                        </tr>';
                                        }

                                        $htmlContent .= '</tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7" style="text-align: right;"><strong>Total</strong></td>
                                                    <td>' . htmlspecialchars(number_format($resEnvioCorreo[0]['pago_factura'], 0)) . '</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    </body>
                                    </html>';

                                        // Configuración del correo
                                        $to = 'feliperenjifoz@gmail.com'; // Cambia esto por la dirección del destinatario
                                        $subject = 'Informe de Proveedor y Productos';
                                        $headers = "MIME-Version: 1.0" . "\r\n";
                                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                        $headers .= 'From: no-reply@example.com' . "\r\n"; // Cambia esto por la dirección del remitente

                                        // Enviar el correo
                                        if (mail($to, $subject, $htmlContent, $headers)) {
                                            echo '<script>window.location="actualizarProducto"</script>';
                                        } else {
                                            echo 'Hubo un error al enviar el correo.';
                                        }
                                    } else {
                                        echo '<script>window.location="actualizarProducto"</script>';
                                    }
                                }
                            }
                        }
                    } else {
                        $agreagr = new ModeloProducto();
                        $res = $agreagr->agregarProductoModelo($id_proeevedor, $codigo[$i], $nombre[$i], $precio[$i], $cantidad[$i], $id_categoria[$i], $id_medida[$i], $id_impuesto[$i], $id_local);
                        if ($res == true) {
                            $agregarFactura = new ControladorFacturaProeevedor();
                            $resFactura = $agregarFactura->agregarFacturaProeevedor($id_categoria[$i], $id_proeevedor, $_SESSION['id_usuario'], $id_medida[$i], $codigo[$i], $nombre[$i], $precio[$i], $cantidad[$i], $id_local, $totalFactura, $precioUnita[$i], $total[$i]);
                            if ($resFactura == true) {
                                if (isset($_SESSION['envioCorreo'])) {
                                    if ($_SESSION['envioCorreo'] == 'true') {

                                        date_default_timezone_set('America/Mexico_City');
                                        $fechaActal = date('Y-m-d');
                                        $enviarCorreo = new ModeloFacturaProeevedor();
                                        $resEnvioCorreo = $enviarCorreo->listarFacturaProductoModelo($id_proeevedor, $fechaActal);
                                        $mostrar = new ModeloProeevedor();
                                        $enviarProe = $mostrar->consultarProeevedorModelo($id_proeevedor);
                                        $htmlContent = '<html>
                                    <head>
                                        <style>
                                            table {
                                                width: 100%;
                                                border-collapse: collapse;
                                            }
                                            th, td {
                                                border: 1px solid #ddd;
                                                padding: 8px;
                                            }
                                            th {
                                                background-color: #f4f4f4;
                                            }
                                            .table-responsive {
                                                overflow-x: auto;
                                            }
                                        </style>
                                    </head>
                                    <body>
                                        <div class="form-row mt-2" style="text-align: center;">
                                            <div class="form-group col-md-3"></div>
                                            <div class="form-group col-md-6">
                                                Proveedor: <span id="nom_proveedor">' . htmlspecialchars($enviarProe[0]['nombre_proeevedor']) . '</span><br>
                                                NIT: <span id="nit_proveedor">' . htmlspecialchars($enviarProe[0]['nit_proeevedor']) . '</span><br>
                                                Teléfono: <span id="tel_proveedor">' . htmlspecialchars($enviarProe[0]['telefono_proeevedor']) . '</span><br>
                                                Dirección: <span id="dir_proveedor">' . htmlspecialchars($enviarProe[0]['direccion_proeevedor']) . '</span>
                                            </div>
                                        </div>
                                        <div class="table-responsive mt-3">
                                            <table class="table mt-2" id="producto">
                                                <thead>
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Producto</th>
                                                        <th>Precio</th>
                                                        <th>Cantidad</th>
                                                        <th>Categoría</th>
                                                        <th>Medida</th>
                                                        <th>Precio Unitario</th>
                                                        <th>Costo * Prod</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                                        foreach ($resEnvioCorreo as $key => $value) {
                                            $htmlContent .= '<tr>
                                            <td>' . htmlspecialchars($value['codigo_producto']) . '</td>
                                            <td>' . htmlspecialchars($value['nombre_producto']) . '</td>
                                            <td>' . htmlspecialchars(number_format($value['precio_unitario'], 0)) . '</td>
                                            <td>' . htmlspecialchars($value['cantidad_producto']) . '</td>
                                            <td>' . htmlspecialchars($value['nombre_categoria']) . '</td>
                                            <td>' . htmlspecialchars($value['nombre_medida']) . '</td>
                                            <td>' . htmlspecialchars(number_format($value['unitario'], 0)) . '</td>
                                            <td>' . htmlspecialchars(number_format($value['total'], 0)) . '</td>
                                        </tr>';
                                        }

                                        $htmlContent .= '</tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="7" style="text-align: right;"><strong>Total</strong></td>
                                                    <td>' . htmlspecialchars(number_format($resEnvioCorreo[0]['pago_factura'], 0)) . '</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    </body>
                                    </html>';

                                        // Configuración del correo
                                        $to = 'feliperenjifoz@gmail.com'; // Cambia esto por la dirección del destinatario
                                        $subject = 'Informe de Proveedor y Productos';
                                        $headers = "MIME-Version: 1.0" . "\r\n";
                                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                        $headers .= 'From: no-reply@example.com' . "\r\n"; // Cambia esto por la dirección del remitente

                                        // Enviar el correo
                                        if (mail($to, $subject, $htmlContent, $headers)) {
                                            echo '<script>window.location="agregarProducto"</script>';
                                        } else {
                                            echo 'Hubo un error al enviar el correo.';
                                        }
                                    } else {
                                        echo '<script>window.location="agregarProducto"</script>';
                                    }
                                }
                            }
                        }
                    }
                }
            } else {
                $id_local = $_SESSION['id_local'];
                for ($i = 0; $i < count($codigo); $i++) {
                    if ($id[$i] != null) {
                        $cantidad_producto = $cant[$i] + $cantidad[$i];
                        $agreagr = new ModeloProducto();
                        $res = $agreagr->actualizarProductoModelo($id[$i], $id_proeevedor, $codigo[$i], $nombre[$i], $precio[$i], $cantidad_producto, $id_categoria[$i], $id_medida[$i],$id_impuesto[$i], $id_local);
                        if ($res == true) {
                            $agregarFactura = new ControladorFacturaProeevedor();
                            $resFactura = $agregarFactura->agregarFacturaProeevedor($id_categoria[$i], $id_proeevedor, $_SESSION['id_usuario'], $id_medida[$i], $codigo[$i], $nombre[$i], $precio[$i], $cantidad[$i], $id_local, $totalFactura, $precioUnita[$i], $total[$i]);
                            if ($resFactura == true) {
                                echo '<script>window.location="actualizarProducto"</script>';
                            }
                        }
                    } else {
                        $agreagr = new ModeloProducto();
                        $res = $agreagr->agregarProductoModelo($id_proeevedor, $codigo[$i], $nombre[$i], $precio[$i], $cantidad[$i], $id_categoria[$i], $id_medida[$i],$id_impuesto[$i], $id_local);
                        if ($res == true) {
                            $agregarFactura = new ControladorFacturaProeevedor();
                            $resFactura = $agregarFactura->agregarFacturaProeevedor($id_categoria[$i], $id_proeevedor, $_SESSION['id_usuario'], $id_medida[$i], $codigo[$i], $nombre[$i], $precio[$i], $cantidad[$i], $id_local, $totalFactura, $precioUnita[$i], $total[$i]);
                            if ($resFactura == true) {
                                echo '<script>window.location="agregarProducto"</script>';
                            }
                        }
                    }
                }
            }
        }
    }

    function listarProducto()
    {
        $listar = new ModeloProducto();
        $res = $listar->listarProductoModelo();
        return $res;
    }

    function listarProductoExcel()
    {
        $listar = new ModeloProducto();
        $res = $listar->listarProductoExcelModelo();
        return $res;
    }

    function consultarProductoAjaxControlador($dato,$id)
    {
        $consultar = new ModeloProducto();
        $res = $consultar->consultarModeloProductoAjaxModelo($dato,$id);
        return $res;
    }

    function consultarProducto()
    {
        $consultar = new ModeloProducto();
        $res = $consultar->consultarProductoModelo($_GET['id']);
        return $res;
    }

    function consultarAritucloProeevedoridAjax($nit)
    {
        $conusltar = new ModeloProducto();
        $res = $conusltar->consultarAritucloProeevedoridAjaxModelo($nit);
        return $res;
    }

    function consultarAritucloProeevedorAjax($id)
    {
        $conusltar = new ModeloProducto();
        $res = $conusltar->consultarAritucloProeevedorAjaxModelo($id);
        return $res;
    }

    function mostrarArticulo($dato)
    {
        $buscar = new ModeloProducto();
        $res = $buscar->mostrarArticuloModelo($dato);
        return $res;
    }

    function actualizarProductoFactura($dato)
    {
        $buscar = new ModeloProducto();
        $res = $buscar->actualizarProductoFacturaModelo($dato);
        return $res;
    }

    function alertarProductosFaltante()
    {
        $alert = new ModeloProducto();
        $res = $alert->alertarProductosFaltanteModelo();
        return $res;
    }

    function eliminaProductoId()
    {
        $id = $_GET['id'];
        $listar = new ModeloProducto();
        $res = $listar->eliminaProductoIdModelo($id);
        if ($res == true) {
            echo '<script>window.location="eliminarProducto"</script>';
        }
    }
}
