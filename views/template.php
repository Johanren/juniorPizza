<?php
session_start();
$local = new ControladorLocal();
if (isset($_SESSION['id_local'])) {
    $res = $local->consultarLocal($_SESSION['id_local']);
} else {
    $res = [];
}
if ($res != null) {
    $nombreSistema = $res[0]['nombre_local'];
    if (strpos($nombreSistema, '58') !== false) {
        $nombreSistema = str_replace('58', '', $nombreSistema);
    }
    $nombreSistema;
    $nit = $res[0]['nit'];
    $tel = $res[0]['telefono'];
    $dire = $res[0]['direccion'];
    $ip = $res[0]['ip'];
} else {
    $nombreSistema = "Inventario";
    $nit = "1111";
    $tel = "1111";
    $dire = "NNNN";
}
ob_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $nombreSistema ?></title>
    <link rel="stylesheet" href="views/css/bootstrap.min.css" />
    <link rel="stylesheet" href="views/css/bootstrap.css" />
    <link rel="stylesheet" href="views/css/dataTables.bootstrap4.min.css" />
    <script src="views/js/jquery-3.3.1.js"></script>
    <script src="views/js/jquery.dataTables.min.js"></script>
    <script src="views/js/dataTables.bootstrap4.min.js"></script>
    <script src="views/js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="views/css/login.css" />
    <link rel="stylesheet" href="views/css/perfil.css" />
    <link rel="stylesheet" href="views/css/cocina.css" />
    <link rel="stylesheet" href="views/css/config.css" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="views/img/icon.jpeg" />
    <link rel="stylesheet" href="views/css/jquery-ui.css" />

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php

        if (isset($_SESSION['validar'])) {
            include("views/moduls/narvar.php");
        }
        ?>
        <?php
        $mvc = new controladorViews();
        $mvc->enlacesPaginaControlador();

        $caja  = new ControladorAbrirCaja();
        $caja->abrirYCerrarCaja();
        ?>
    </div>
    <?php
    if (isset($_SESSION['validar'])) {
        include("views/moduls/footer.php");
    }
    ?>
    <?php
    if (isset($_SESSION['impresionPos'])) {
        if ($_SESSION['impresionPos'] == 'true') {
    ?>
            <input type="hidden" id="<?php if ($_SESSION['impresionPos'] == 'true') { ?>btnImprimir<?php } ?>">
    <?php
        }
    } ?>
    <input type="hidden" id="btnImprimirDomicilio">
    <input type="hidden" id="reproducirAudio">
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Recordatorio</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <?php
                    $evento = new ControladorEvento();
                    $res = $evento->consultarEventoVentanaControlador();
                    if (empty($res)) {
                    ?>
                        <h4 style="text-align: center;">No tienes eventos para hoy</h4>
                    <?php
                    } else {
                    ?>
                        <div class="table-responsive">
                            <table class="table" id="usuario">
                                <thead>
                                    <tr>
                                        <th>Evento</th>
                                        <th>Descripcion</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($res as $key => $value) {
                                        $matriz = explode(" ", $value['start']);
                                    ?>
                                        <tr>
                                            <td><?php echo $value['title'] ?></td>
                                            <td><?php echo $value['descripcion'] ?></td>
                                            <td><?php echo $matriz[0] ?></td>
                                            <td><?php echo $matriz[1] ?></td>
                                        </tr>
                                <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>

                </div>
            </div>
        </div>
    </div>
    <?php
    //Impresion COMANDAS MESA
    if (isset($_SESSION['impresionPos'])) {
        if ($_SESSION['impresionPos'] == 'true') {
            $nombreSistema = "Comanda de Cocina";
            $mesa = "1111";
            $usuario = "1111";
    ?>
            <script>
                /* ==========================================
                VARIABLES GLOBALES (SE MANTIENEN IGUAL)
                ===========================================*/
                let printDomicilio = 0;
                let idMesaDomicilio = 0;
                const URLImpresionPlugin = "http://localhost:8000";

                var print = 0;
                var id_mesa = 0;
                const URLPlugin = "http://localhost:8000";


                /* ==========================================
                   UTILIDADES COMPARTIDAS (UNIFICADAS)
                ===========================================*/
                const separarCadenaEnArregloSiSuperaLongitud = (cadena, maximaLongitud) => {
                    const resultado = [];
                    let indice = 0;
                    while (indice < cadena.length) {
                        const pedazo = cadena.substring(indice, indice + maximaLongitud);
                        indice += maximaLongitud;
                        resultado.push(pedazo);
                    }
                    return resultado;
                };

                const dividirCadenasYEncontrarMayorConteoDeBloques = (contenidosConMaximaLongitud) => {
                    let mayor = 0;
                    const separadas = [];
                    for (const contenido of contenidosConMaximaLongitud) {
                        const trozos = separarCadenaEnArregloSiSuperaLongitud(
                            String(contenido.contenido),
                            contenido.maximaLongitud
                        );
                        separadas.push({
                            separadas: trozos,
                            maximaLongitud: contenido.maximaLongitud,
                        });
                        if (trozos.length > mayor) mayor = trozos.length;
                    }
                    return [separadas, mayor];
                };

                const tabularDatos = (cadenas, relleno, separadorColumnas) => {
                    const [arreglos, mayorConteo] =
                    dividirCadenasYEncontrarMayorConteoDeBloques(cadenas);

                    const lineas = [];
                    for (let i = 0; i < mayorConteo; i++) {
                        let linea = "";
                        for (const contenido of arreglos) {
                            let cad = contenido.separadas[i] || "";
                            if (cad.length < contenido.maximaLongitud) {
                                cad += relleno.repeat(contenido.maximaLongitud - cad.length);
                            }
                            linea += cad + separadorColumnas;
                        }
                        lineas.push(linea);
                    }
                    return lineas;
                };


                /* ==========================================
                   SEPARADOR Y TABLA (UNIFICADO)
                ===========================================*/
                function obtenerLineaSeparadora(maxNom, maxCant, maxDesc) {
                    const lineas = tabularDatos(
                        [{
                                contenido: "-",
                                maximaLongitud: maxNom
                            },
                            {
                                contenido: "-",
                                maximaLongitud: maxCant
                            },
                            {
                                contenido: "-",
                                maximaLongitud: maxDesc
                            },
                        ],
                        "-",
                        "+"
                    );
                    return lineas.length ? lineas[0] : "";
                }

                function construirTabla(productos, cfg) {
                    const separador = obtenerLineaSeparadora(cfg.maxNom, cfg.maxCant, cfg.maxDesc);
                    let tabla = separador + "\n";

                    const encabezado = tabularDatos(
                        [{
                                contenido: "Nombre",
                                maximaLongitud: cfg.maxNom
                            },
                            {
                                contenido: "Cant",
                                maximaLongitud: cfg.maxCant
                            },
                            {
                                contenido: "Descripcion",
                                maximaLongitud: cfg.maxDesc
                            },
                        ],
                        cfg.relleno,
                        cfg.separador
                    );

                    encabezado.forEach((l) => (tabla += l + "\n"));
                    tabla += separador + "\n";

                    for (const p of productos) {
                        const filas = tabularDatos(
                            [{
                                    contenido: p.nombre,
                                    maximaLongitud: cfg.maxNom
                                },
                                {
                                    contenido: p.cantidad.toString(),
                                    maximaLongitud: cfg.maxCant
                                },
                                {
                                    contenido: p.descripcion.toString(),
                                    maximaLongitud: cfg.maxDesc
                                },
                            ],
                            cfg.relleno,
                            cfg.separador
                        );
                        filas.forEach((f) => (tabla += f + "\n"));
                        tabla += separador + "\n";
                    }

                    return tabla;
                }


                /* ==========================================
                   AJAX UNIFICADO
                ===========================================*/
                function ajaxGetJson(url, data) {
                    return new Promise((resolve) => {
                        $.ajax({
                            url,
                            type: "GET",
                            dataType: "json",
                            data,
                            success: resolve,
                            error: () => resolve([]),
                        });
                    });
                }


                /* ==========================================
                   ---------- IMPRESIÓN DOMICILIO ----------
                ===========================================*/

                window.onload = () => {
                    cargarProductos();
                    console.log();
                };

                function cargarProductos() {
                    $.ajax({
                        url: "views/ajax.php",
                        type: "GET",
                        dataType: "json",
                        data: {
                            printDomicilio
                        },
                        success: inicializarImpresion,
                    });
                }

                function inicializarImpresion(listaProductos) {
                    const btn = document.querySelector("#btnImprimirDomicilio");

                    if (!btn) return;

                    const cfg = {
                        separador: document.querySelector("#separador").value,
                        relleno: document.querySelector("#relleno").value,
                        maxNom: parseInt(document.querySelector("#maximaLongitudNombre").value),
                        maxCant: parseInt(document.querySelector("#maximaLongitudCantidad").value),
                        maxDesc: parseInt(document.querySelector("#maximaLongitudPrecio").value),
                    };

                    btn.onclick = () => imprimirTodo(listaProductos, cfg);
                }

                function obtenerClientes() {
                    return ajaxGetJson("views/ajax.php", {
                        printCliente: printDomicilio,
                    });
                }

                function marcarImpresa(id) {
                    return ajaxGetJson("views/ajax.php", {
                        respuestaPrintDomicilio: printDomicilio,
                        id,
                    });
                }

                async function imprimirTodo(listaProductos, cfg) {
                    const bebidas = listaProductos.filter((p) => p.categoria === "Bebidas");
                    const otros = listaProductos.filter((p) => p.categoria !== "Bebidas");

                    let tablaBebidas =
                        bebidas.length > 0 ? construirTabla(bebidas, cfg) : "";
                    let tablaOtros = otros.length > 0 ? construirTabla(otros, cfg) : "";

                    const conector = new ConectorPluginV3(URLImpresionPlugin);

                    const clientes = await obtenerClientes();

                    for (const cliente of clientes) {
                        if (bebidas.length) await imprimirTicket(conector, cliente, tablaBebidas);
                        if (otros.length) await imprimirTicket(conector, cliente, tablaOtros);
                        await marcarImpresa(cliente.id);
                    }

                    location.reload();
                }

                async function imprimirTicket(conector, cliente, tabla) {
                    return await conector
                        .Iniciar()
                        .DeshabilitarElModoDeCaracteresChinos()
                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO)
                        .Feed(1)
                        .EscribirTexto("<?php echo $nombreSistema ?>\n")
                        .EscribirTexto("Fecha: " + new Intl.DateTimeFormat("es-MX").format(new Date()) + "\n")
                        .TextoSegunPaginaDeCodigos(2, "cp850", "Cliente: " + cliente.nombre + "\n")
                        .Feed(1)
                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
                        .EscribirTexto(tabla)
                        .EscribirTexto("----------------------------------------------\n")
                        .Feed(3)
                        .Corte(1)
                        .Pulso(48, 60, 120)
                        .imprimirEn("caja");
                }



                /* ==========================================
                   ---------- IMPRESIÓN DE MESA NORMAL ----------
                ===========================================*/

                async function actualizarEstadoMesa() {
                    return ajaxGetJson("views/ajax.php", {
                        respuestaPrint: print,
                        id: id_mesa,
                    });
                }

                async function imprimirConectorParaProducto(conector, tabla, producto, destino) {
                    return await conector
                        .Iniciar()
                        .DeshabilitarElModoDeCaracteresChinos()
                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO)
                        .Feed(1)
                        .EscribirTexto("<?php echo $nombreSistema ?>\n")
                        .TextoSegunPaginaDeCodigos(2, "cp850", producto.mesa + "\n")
                        .EscribirTexto("Fecha: " + new Intl.DateTimeFormat("es-MX").format(new Date()) + "\n")
                        .TextoSegunPaginaDeCodigos(2, "cp850", "Atendido por:" + producto.nombre + " " + producto.apellido + "\n")
                        .Feed(1)
                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
                        .EscribirTexto(tabla)
                        .EscribirTexto("------------------------------------------------\n")
                        .Feed(3)
                        .Corte(1)
                        .Pulso(48, 60, 120)
                        .imprimirEn(destino);
                }

                async function flujoPrincipalDeImpresion() {
                    const lista = await ajaxGetJson("views/ajax.php", {
                        print
                    });

                    const bebidas = lista.filter((p) => p.categoria === "Bebidas");
                    const otros = lista.filter((p) => p.categoria !== "Bebidas");

                    const cfg = {
                        maxNom: 20,
                        maxCant: 6,
                        maxDesc: 16,
                        relleno: " ",
                        separador: " ",
                    };

                    const tablaBebidas = bebidas.length ? construirTabla(bebidas, cfg) : "";
                    const tablaOtros = otros.length ? construirTabla(otros, cfg) : "";

                    const conector = new ConectorPluginV3(URLPlugin);

                    const pedidos = await ajaxGetJson("views/ajax.php", {
                        printUsuario: print
                    });

                    for (const producto of pedidos) {
                        if (bebidas.length) await imprimirConectorParaProducto(conector, tablaBebidas, producto, "caja");
                        if (otros.length) await imprimirConectorParaProducto(conector, tablaOtros, producto, "cocina");
                        await actualizarEstadoMesa();
                        location.reload();
                    }
                }

                document.addEventListener("DOMContentLoaded", () => {
                    const btn = document.querySelector("#btnImprimir");
                    const btn1 = document.querySelector("#btnImprimirDomicilio");
                    if (btn) btn.onclick = flujoPrincipalDeImpresion;
                    if (btn1) btn1.onclick = cargarProductos;
                });
            </script>
    <?php
        }
    }
    ?>



</body>
<script src="views/js/table.js"></script>

<!-- Bootstrap core JavaScript-->
<!--<script src="vendor/jquery/jquery.min.js"></script>-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<!--<script src="vendor/jquery-easing/jquery.easing.min.js"></script>-->

<!-- Custom scripts for all pages-->
<script src="views/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="views/js/demo/chart-area-demo.js"></script>
<script src="views/js/demo/chart-pie-demo.js"></script>
<script src="views/js/jquery-ui.js"></script>
<script src="views/js/ConectorJavaScript.js"></script>
<script src="views/js/js.js"></script>




</html>