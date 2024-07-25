<?php
$cantidad = new ControladorVenta();
$res = $cantidad->consultarVentaDia();
$total = $cantidad->ventaTotalDia();
#Gasto
$proeevedor = new ControladorGasto();
$resGas = $proeevedor->TotalGasto();
#TotalPgoProeevedor
$proeevedor = new ControladorFacturaProeevedor();
$resPro = $proeevedor->DeudaProeevedor();
#TotalNomina
$nomina = new ControladorNomina();
$resNomina = $nomina->deudaNomina();
////
$local = new ControladorLocal();
$resLocal = $local->consultarLocal($_SESSION['id_local']);
///
$listarFactura = new ControladorFactura();
$reslistar = $listarFactura->listarFacturaCliente();
if ($resLocal != null) {
    $nombreSistema = $resLocal[0]['nombre_local'];
    $nit = $resLocal[0]['nit'];
    $tel = $resLocal[0]['telefono'];
    $dire = $resLocal[0]['direccion'];
} else {
    $nombreSistema = "Inventario";
    $nit = "1111";
    $tel = "1111";
    $dire = "NNNN";
}
if (isset($_POST['cierre'])) {
    $cerrarCaja = new ControladorAbrirCaja();
    $cerrarCaja->cerrarCajaControlador();
}
?>
<h1 style="text-align: center; color: black; font-weight: 500;">VENTA DEL DIA</h1>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <form method="post" class="mt-3">
                <div class="row">
                    <div class="col">
                        <input type="date" class="form-control" name="buscar">
                    </div>
                    <div class="col">
                        <button type="hidden" name="consultar" class="btn btn-primary">Buscar</button>
                    </div>
                    <div class="col">
                        <a id="<?php if(!isset($_SESSION['caja'])){ echo "disabled";}else{ echo "Imprimir"; } ?>" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                                <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
                            </svg></a>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-receipt-cutoff" viewBox="0 0 16 16">
                                <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
                                <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z" />
                            </svg>
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" name="cierre">
                            <i class="fas fa-door-open fa-lg"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="table-responsive">
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Productos Vendidos</th>
                    <th>Valor unitario</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <?php
            foreach ($res as $key => $value) {
                
                if ($value['metodo_pago'] == 'efectivo') {
                    $res_cantidad_total = $cantidad->consultarVentaDiaCantidadTotal($value['id_producto'], $value['metodo_pago']);
            ?>
                    <thead>
                        <tr>
                            <th>Efectivo</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($res_cantidad_total as $key => $valueCantidad) {
                    ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $value['nombre_producto'] ?>
                                </td>
                                <td>
                                    <?php echo $value["CONCAT('$', FORMAT(valor_unitario, '$#,##0.00'))"] ?>
                                    </th>
                                <td>
                                    <?php echo $valueCantidad['SUM(cantidad)'] ?>
                                </td>
                                <td>
                                    <?php echo $valueCantidad["CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00'))"] ?>
                                </td>
                                <td>
                                    <?php echo $value['fecha_ingreso'] ?>
                                </td>
                            </tr>
                        </tbody>
                    <?php
                    }
                } elseif ($value['metodo_pago'] == 'nequi') {
                    $res_cantidad_total = $cantidad->consultarVentaDiaCantidadTotal($value['id_producto'], $value['metodo_pago']);
                    ?>
                    <thead>
                        <tr>
                            <th>Nequi</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($res_cantidad_total as $key => $valueCantidad) {
                    ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $value['nombre_producto'] ?>
                                </td>
                                <td>
                                    <?php echo $value["CONCAT('$', FORMAT(valor_unitario, '$#,##0.00'))"] ?>
                                    </th>
                                <td>
                                    <?php echo $valueCantidad['SUM(cantidad)'] ?>
                                </td>
                                <td>
                                    <?php echo $valueCantidad["CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00'))"] ?>
                                </td>
                                <td>
                                    <?php echo $value['fecha_ingreso'] ?>
                                </td>
                            </tr>
                        </tbody>
                    <?php
                    }
                } elseif ($value['metodo_pago'] == 'daviplata') {
                    $res_cantidad_total = $cantidad->consultarVentaDiaCantidadTotal($value['id_producto'], $value['metodo_pago']);
                    ?>
                    <thead>
                        <tr>
                            <th>Daviplata</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($res_cantidad_total as $key => $valueCantidad) {
                    ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $value['nombre_producto'] ?>
                                </td>
                                <td>
                                    <?php echo $value["CONCAT('$', FORMAT(valor_unitario, '$#,##0.00'))"] ?>
                                    </th>
                                <td>
                                    <?php echo $valueCantidad['SUM(cantidad)'] ?>
                                </td>
                                <td>
                                    <?php echo $valueCantidad["CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00'))"] ?>
                                </td>
                                <td>
                                    <?php echo $value['fecha_ingreso'] ?>
                                </td>
                            </tr>
                        </tbody>
                    <?php
                    }
                } elseif ($value['metodo_pago'] == 'transfferencia') {
                    $res_cantidad_total = $cantidad->consultarVentaDiaCantidadTotal($value['id_producto'], $value['metodo_pago']);
                    ?>
                    <thead>
                        <tr>
                            <th>Transferencia</th>
                        </tr>
                    </thead>
                    <?php
                    foreach ($res_cantidad_total as $key => $valueCantidad) {
                    ?>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $value['nombre_producto'] ?>
                                </td>
                                <td>
                                    <?php echo $value["CONCAT('$', FORMAT(valor_unitario, '$#,##0.00'))"] ?>
                                    </th>
                                <td>
                                    <?php echo $valueCantidad['SUM(cantidad)'] ?>
                                </td>
                                <td>
                                    <?php echo $valueCantidad["CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00'))"] ?>
                                </td>
                                <td>
                                    <?php echo $value['fecha_ingreso'] ?>
                                </td>
                            </tr>
                        </tbody>
            <?php
                    }
                }
            }
            ?>
            <?php
            $agrupar = new   ControladorVenta();
            $listarAgru  = $agrupar->listarMetodosPago();
            foreach ($listarAgru as $key => $value) {
            ?>
                <tbody>
                    <tr>
                        <th><?php echo "Pagos con " . $value['metodo_pago'] ?></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                            <?php $totalmedio = $agrupar->metodosPagoTotal($value['metodo_pago']);
                            echo "$" . number_format($totalmedio[0]['SUM(venta.precio_compra)'], 0) ?>
                        </th>
                    </tr>
                </tbody>
            <?php
            }
            ?>
            <tbody>
                <tr>
                    <th>SubTotal</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <?php echo $total[0]["CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00'))"] ?>
                    </th>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th>Subtotal Gastos</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <?php echo $resGas[0]["CONCAT('$', FORMAT(SUM(total), '$#,##0.00'))"] ?>
                    </th>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th>Subtotal Proeevedores</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <?php echo $resPro[0]["CONCAT('$', FORMAT(SUM(DISTINCT(pago_factura)), '$#,##0.00'))"] ?>
                    </th>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th>Subtotal Nomina</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <?php echo $resNomina[0]["CONCAT('$', FORMAT(SUM(pago), '$#,##0.00'))"] ?>
                    </th>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th>Base Caja</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <?php $base = isset($_SESSION['caja']['monto_inicial']) ? $_SESSION['caja']['monto_inicial'] : 0;
                        echo '$' . number_format($base, 0); ?>
                    </th>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th>Total</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>
                        <?php $totalVenta = ($total[0]['SUM(precio_compra)'] - $resPro[0]['SUM(DISTINCT(pago_factura))'] - $resNomina[0]['SUM(pago)'] - $resGas[0]['SUM(total)']) + $base;
                        echo '$' . number_format($totalVenta, 0) ?>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Facturas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" name="cc" placeholder="CC">
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="fecha">
                        </div>
                        <div class="col">
                            <button type="hidden" name="buscarr" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th>Numero factura</th>
                            <th>Cedula cliente</th>
                            <th>Nombre cliente</th>
                            <th>Fecha factura</th>
                            <th>Total Compra</th>
                            <th>Imprimir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($reslistar as $key => $value) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $value['id_factura'] ?>
                                </td>
                                <td>
                                    <?php echo $value['numero_cc'] ?>
                                </td>
                                <td>
                                    <?php echo $value['primer_nombre'] . " " . $value['primer_apellido'] ?>
                                </td>
                                <td>
                                    <?php echo $value['fecha_factura'] ?>
                                </td>
                                <td>
                                    <?php echo number_format($value['total_factura'],0) ?>
                                </td>
                                <td><a href="index.php?action=factura_pdf&id_factura=<?php echo $value['id_factura'] ?>"><button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-receipt-cutoff" viewBox="0 0 16 16">
                                                <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
                                                <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z" />
                                            </svg></button></a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="columns">
        <div class="column">
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <div class="select is-rounded">
                <select hidden id="listaDeImpresoras"></select>
            </div>
            <div class="field">
                <!--<label class="label">Separador</label>-->
                <div class="control">
                    <input hidden id="separador" value=" " class="input" type="text" maxlength="1" placeholder="El separador de columnas">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Relleno</label>-->
                <div class="control">
                    <input hidden id="relleno" value=" " class="input" type="text" maxlength="1" placeholder="El relleno de las celdas">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el nombre</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudNombre" value="20" class="input" type="number">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para la cantidad</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudCantidad" value="8" class="input" type="number">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el precio</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudPrecio" value="8" class="input" type="number">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //Imprimir

    document.addEventListener("DOMContentLoaded", async () => {
        // Las siguientes 3 funciones fueron tomadas de: https://parzibyte.me/blog/2023/02/28/javascript-tabular-datos-limite-longitud-separador-relleno/
        // No tienen que ver con el plugin, solo son funciones de JS creadas por mí para tabular datos y enviarlos
        // a cualquier lugar
        const separarCadenaEnArregloSiSuperaLongitud = (cadena, maximaLongitud) => {
            const resultado = [];
            let indice = 0;
            while (indice < cadena.length) {
                const pedazo = cadena.substring(indice, indice + maximaLongitud);
                indice += maximaLongitud;
                resultado.push(pedazo);
            }
            return resultado;
        }
        const dividirCadenasYEncontrarMayorConteoDeBloques = (contenidosConMaximaLongitud) => {
            let mayorConteoDeCadenasSeparadas = 0;
            const cadenasSeparadas = [];
            for (const contenido of contenidosConMaximaLongitud) {
                const separadas = separarCadenaEnArregloSiSuperaLongitud(contenido.contenido, contenido.maximaLongitud);
                cadenasSeparadas.push({
                    separadas,
                    maximaLongitud: contenido.maximaLongitud
                });
                if (separadas.length > mayorConteoDeCadenasSeparadas) {
                    mayorConteoDeCadenasSeparadas = separadas.length;
                }
            }
            return [cadenasSeparadas, mayorConteoDeCadenasSeparadas];
        }
        const tabularDatos = (cadenas, relleno, separadorColumnas) => {
            const [arreglosDeContenidosConMaximaLongitudSeparadas, mayorConteoDeBloques] = dividirCadenasYEncontrarMayorConteoDeBloques(cadenas)
            let indice = 0;
            const lineas = [];
            while (indice < mayorConteoDeBloques) {
                let linea = "";
                for (const contenidos of arreglosDeContenidosConMaximaLongitudSeparadas) {
                    let cadena = "";
                    if (indice < contenidos.separadas.length) {
                        cadena = contenidos.separadas[indice];
                    }
                    if (cadena.length < contenidos.maximaLongitud) {
                        cadena = cadena + relleno.repeat(contenidos.maximaLongitud - cadena.length);
                    }
                    linea += cadena + separadorColumnas;
                }
                lineas.push(linea);
                indice++;
            }
            return lineas;
        }


        const obtenerListaDeImpresoras = async () => {
            return await ConectorPluginV3.obtenerImpresoras();
        }
        const URLPlugin = "http://localhost:8000"
        const $listaDeImpresoras = document.querySelector("#listaDeImpresoras"),
            $btnImprimir = document.querySelector("#Imprimir"),
            $separador = document.querySelector("#separador"),
            $relleno = document.querySelector("#relleno"),
            $maximaLongitudNombre = document.querySelector("#maximaLongitudNombre"),
            $maximaLongitudCantidad = document.querySelector("#maximaLongitudCantidad"),
            $maximaLongitudPrecio = document.querySelector("#maximaLongitudPrecio");
        $maximaLongitudPrecioTotal = document.querySelector("#maximaLongitudPrecio");

        const init = async () => {
            /*const impresoras = await ConectorPluginV3.obtenerImpresoras();
            for (const impresora of impresoras) {
                $listaDeImpresoras.appendChild(Object.assign(document.createElement("option"), {
                    value: impresora,
                    text: impresora,
                }));
            }*/
            $btnImprimir.addEventListener("click", () => {
                const nombreImpresora = "prueba1";
                if (!nombreImpresora) {
                    return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
                }
                imprimirTabla("prueba1");
            });
        }


        const imprimirTabla = async (nombreImpresora) => {
            const maximaLongitudNombre = parseInt($maximaLongitudNombre.value),
                maximaLongitudCantidad = parseInt($maximaLongitudCantidad.value),
                maximaLongitudPrecio = parseInt($maximaLongitudPrecio.value),
                maximaLongitudPrecioTotal = parseInt($maximaLongitudPrecio.value),
                relleno = $relleno.value,
                separadorColumnas = $separador.value;
            const obtenerLineaSeparadora = () => {
                const lineasSeparador = tabularDatos(
                    [{
                            contenido: "-",
                            maximaLongitud: maximaLongitudNombre
                        },
                        {
                            contenido: "-",
                            maximaLongitud: maximaLongitudCantidad
                        },
                        {
                            contenido: "-",
                            maximaLongitud: maximaLongitudPrecio
                        },
                        {
                            contenido: "-",
                            maximaLongitud: maximaLongitudPrecioTotal
                        },
                    ],
                    "-",
                    "+",
                );
                let separadorDeLineas = "";
                if (lineasSeparador.length > 0) {
                    separadorDeLineas = lineasSeparador[0]
                }
                return separadorDeLineas;
            }
            // Simple lista de ejemplo. Obviamente tú puedes traerla de cualquier otro lado,
            // definir otras propiedades, etcétera
            const listaDeProductos = [
                <?php

                foreach ($res as $key => $value) {
                    $res_cantidad_total = $cantidad->consultarVentaDiaCantidadTotal($value['id_producto'], $value['metodo_pago']);
                    foreach ($res_cantidad_total as $key => $valueCantidad) {
                ?> {
                            nombre: "<?php echo $value['nombre_producto'] ?>",
                            cantidad: "<?php if ($valueCantidad['SUM(cantidad)'] > 0) {
                                            echo $valueCantidad['SUM(cantidad)'];
                                        } else {
                                            echo $valueCantidad['SUM(peso)'];
                                        } ?>",
                            metodoPago: "<?php echo $value['metodo_pago'] ?>",
                            precioTotal: "<?php echo $valueCantidad["CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00'))"] ?>",
                        },
                <?php
                    }
                }
                ?>
            ];
            // Comenzar a diseñar la tabla
            let tabla = obtenerLineaSeparadora() + "\n";


            const lineasEncabezado = tabularDatos([

                    {
                        contenido: "Nombre",
                        maximaLongitud: maximaLongitudNombre
                    },
                    {
                        contenido: "Cantidad",
                        maximaLongitud: maximaLongitudCantidad
                    },
                    {
                        contenido: "Metodo Pago",
                        maximaLongitud: maximaLongitudPrecio
                    },
                    {
                        contenido: "Total",
                        maximaLongitud: maximaLongitudPrecioTotal
                    },
                ],
                relleno,
                separadorColumnas,
            );

            for (const linea of lineasEncabezado) {
                tabla += linea + "\n";
            }
            tabla += obtenerLineaSeparadora() + "\n";
            for (const producto of listaDeProductos) {
                const lineas = tabularDatos(
                    [{
                            contenido: producto.nombre,
                            maximaLongitud: maximaLongitudNombre
                        },
                        {
                            contenido: producto.cantidad.toString(),
                            maximaLongitud: maximaLongitudCantidad
                        },
                        {
                            contenido: producto.metodoPago,
                            maximaLongitud: maximaLongitudPrecio
                        },
                        {
                            contenido: producto.precioTotal.toString(),
                            maximaLongitud: maximaLongitudPrecio
                        },
                    ],
                    relleno,
                    separadorColumnas
                );
                for (const linea of lineas) {
                    tabla += linea + "\n";
                }
                tabla += obtenerLineaSeparadora() + "\n";
            }
            console.log(tabla);



            const conector = new ConectorPluginV3(URLPlugin);
            const respuesta = await conector
                .Iniciar()
                .DeshabilitarElModoDeCaracteresChinos()
                .EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO)
                /*.DescargarImagenDeInternetEImprimir("http://<?php echo $_SERVER['HTTP_HOST'] ?>/inventario/<?php if ($diseno != null) {
                                                                                                                    echo $diseno[0]['icon_sistema'];
                                                                                                                } else {
                                                                                                                    echo "Views/img/img.jpg";
                                                                                                                } ?>", 0, 216)*/
                .Feed(1)
                .EscribirTexto("<?php echo $nombreSistema ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Nit: <?php echo $nit ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Teléfono: <?php echo $tel ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Direccion: <?php echo $dire ?>\n")
            <?php
            if (isset($_POST['buscar'])) {
            ?>
                    .EscribirTexto("Fecha: <?php echo $_POST['buscar'] ?>")
            <?php
            } else {
            ?>
                    .EscribirTexto("Fecha: " + (new Intl.DateTimeFormat("es-MX").format(new Date())))
            <?php
            }
            ?>
                .Feed(1)
                .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
                .EscribirTexto("____________________\n")
                .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
                .EscribirTexto(tabla)
                .EscribirTexto("------------------------------------------------\n")
            <?php
            $agrupar = new   ControladorVenta();
            $listarAgru  = $agrupar->listarMetodosPago();
            foreach ($listarAgru as $key => $value) {
            ?>
                    .EscribirTexto("<?php echo "Pagos con " . $value['metodo_pago'] ?> <?php $totalmedio = $agrupar->metodosPagoTotal($value['metodo_pago']);
                                                                                        echo "$" . number_format($totalmedio[0]['SUM(venta.precio_compra)'], 0) ?>\n")
            <?php
            }
            ?>
                .EscribirTexto("SubTotal <?php echo $total[0]["CONCAT('$', FORMAT(SUM(precio_compra), '$#,##0.00'))"] ?>\n")
                .EscribirTexto("Subtotal Gasto <?php echo $resGas[0]["CONCAT('$', FORMAT(SUM(total), '$#,##0.00'))"] ?>\n")
                .EscribirTexto("Subtotal Proeevedores <?php echo $resPro[0]["CONCAT('$', FORMAT(SUM(DISTINCT(pago_factura)), '$#,##0.00'))"] ?>\n")
                .EscribirTexto("Subtotal Nomina <?php echo $resNomina[0]["CONCAT('$', FORMAT(SUM(pago), '$#,##0.00'))"] ?>\n")
                .EscribirTexto("Base Caja $<?php echo number_format($base, 0) ?>\n")
                .EscribirTexto("Total $<?php echo number_format($totalVenta, 0) ?>\n")
                .Feed(3)
                .Corte(1)
                .Pulso(48, 60, 120)
                .imprimirEn("prueba1");
            if (respuesta === true) {
                alert("Impreso correctamente");
            } else {
                alert("Error: " + respuesta);
            }
        }
        init();
    });
</script>