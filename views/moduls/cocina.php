<?php

if (isset($_GET['action'])) {
    if ($_GET['action'] == "agregarMesa") {
        print '<script>
        swal("Hurra!!!", "Mesa agregada exitosamente", "success");
    </script>';
    }
}
$listarPedido = new ControladorPedido();
$res = $listarPedido->ListarMesaPedido();
$listarPedido->actualizarPedidoPrint();
date_default_timezone_set('America/Mexico_City');
$fechaActal = date('Y-m-d');
?>
<div class="container">
    <div class="row">
        <?php
        foreach ($res as $key => $value) {
            $respedido = $listarPedido->listarPedidoCocina($value['id_mesa'], $value['fecha_ingreso']);
            ?>
            <div class="col-sm-3 mt-3">
                <div class="comanda">
                    <div class="comanda-header">
                        <h2>Comanda de Cocina</h2>
                        <br>
                        <h5><?php echo $value['nombre_mesa'] ?> Fecha: <?php echo $value['fecha_ingreso'] ?></h5>
                    </div>
                    <?php
                    foreach ($respedido as $key => $pedido) {
                        ?>
                        <div class="comanda-body">
                            <div class="comanda-item">
                                <span class="cantidad"><?php echo $pedido['cantidad'] ?></span>
                                <span class="producto"><?php echo $pedido['producto'] ?></span>
                                <br>
                                <span class="descripcion"><?php echo $pedido['descripcion'] ?></span>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="comanda-footer">
                        <p>Atendido por: <span
                                class="chef"><?php echo $value['primer_nombre'] . " " . $value['primer_apellido'] ?></span>
                        </p>
                        <br>
                        <a id="<?php if (isset($_GET['id_mesa'])) {
                            if ($_GET['id_mesa'] == $pedido['id_mesa'] && $_GET['fecha'] == $value['fecha_ingreso']) {
                                print "btnImprimir";
                            } else {
                                print "";
                            }
                        } ?>" href="<?php if (isset($_GET['id_mesa'])) {
                             if ($_GET['id_mesa'] == $pedido['id_mesa'] && $_GET['fecha'] == $value['fecha_ingreso']) {
                                 print "#";
                             } else {
                                 print "index.php?action=cocina&id_mesa=" . $pedido['id_mesa'] . "&fecha=" . $value['fecha_ingreso'];
                             }
                         } else {
                             print "index.php?action=cocina&id_mesa=" . $pedido['id_mesa'] . "&fecha=" . $value['fecha_ingreso'];
                         } ?>"><i class="fas fa-print fa-lg"></i></a>
                        <a
                            href="index.php?action=cocina&estado=<?php print $pedido['id_mesa'] ?>&fecha=<?php print $pedido['fecha_ingreso'] ?>"><i
                                class="fas fa-hand-point-right fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
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
                    <input hidden id="separador" value=" " class="input" type="text" maxlength="1"
                        placeholder="El separador de columnas">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Relleno</label>-->
                <div class="control">
                    <input hidden id="relleno" value=" " class="input" type="text" maxlength="1"
                        placeholder="El relleno de las celdas">
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
                    <input hidden id="maximaLongitudCantidad" value="5" class="input" type="number">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el precio</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudPrecio" value="20" class="input" type="number">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el precio</label>-->
                <div class="control">
                    <input hidden id="id_mesa" value="<?php if(isset($_GET['id_mesa'])){echo $_GET['id_mesa'];} ?>" class="input" type="text">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el precio</label>-->
                <div class="control">
                    <input hidden id="fecha" value="<?php if(isset($_GET['fecha'])){echo $_GET['fecha'];} ?>" class="input" type="text">
                </div>
            </div>
        </div>
    </div>
</div>
<div id="respuestaServidor"></div>
<?php
if (isset($_GET['id_mesa'])) {
    $nombreSistema = "Comanda de Cocina";
    $mesa = "1111";
    $usuario = "1111";
    ?>
    <script>

        var print = 0;
        var id_mesa = $('#id_mesa').val();
        var fecha = $('#fecha').val();

        $.ajax({
            url: 'views/ajax.php',
            type: 'get',
            dataType: 'json',
            data: { id_mesa: id_mesa, fecha: fecha },
            success: function (response) {
                //console.log(response.nombre);
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
                            cadenasSeparadas.push({ separadas, maximaLongitud: contenido.maximaLongitud });
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
                        $btnImprimir = document.querySelector("#btnImprimir"),
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
                            const nombreImpresora = "Xprinter1";
                            if (!nombreImpresora) {
                                return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
                            }
                            imprimirTabla("Xprinter1");
                        });
                    }


                    const imprimirTabla = async (nombreImpresora) => {
                        const maximaLongitudNombre = parseInt($maximaLongitudNombre.value),
                            maximaLongitudCantidad = parseInt($maximaLongitudCantidad.value),
                            maximaLongitudPrecio = parseInt($maximaLongitudPrecio.value),
                            relleno = $relleno.value,
                            separadorColumnas = $separador.value;
                        const obtenerLineaSeparadora = () => {
                            const lineasSeparador = tabularDatos(
                                [
                                    { contenido: "-", maximaLongitud: maximaLongitudNombre },
                                    { contenido: "-", maximaLongitud: maximaLongitudCantidad },
                                    { contenido: "-", maximaLongitud: maximaLongitudPrecio },
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
                        const listaDeProductos = response;
                        //console.log(listaDeProductos);

                        // Comenzar a diseñar la tabla
                        let tabla = obtenerLineaSeparadora() + "\n";


                        const lineasEncabezado = tabularDatos([

                            { contenido: "Nombre", maximaLongitud: maximaLongitudNombre },
                            { contenido: "Cantidad", maximaLongitud: maximaLongitudCantidad },
                            { contenido: "Descripcion", maximaLongitud: maximaLongitudPrecio },
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
                                [
                                    { contenido: producto.nombre, maximaLongitud: maximaLongitudNombre },
                                    { contenido: producto.cantidad.toString(), maximaLongitud: maximaLongitudCantidad },
                                    { contenido: producto.descripcion.toString(), maximaLongitud: maximaLongitudPrecio },
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

                        $.ajax({
                            url: 'views/ajax.php',
                            type: 'GET',
                            dataType: 'json',
                            data: { id_mesa: id_mesa, fechaActual: fecha },
                            success: async function (response) {
                                const listarPedido = response;
                                for (const producto of listarPedido) {
                                    // Extraer el valor específico del array devuelto
                                    const respuesta = await conector
                                        .Iniciar()
                                        .DeshabilitarElModoDeCaracteresChinos()
                                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO)
                                        //.DescargarImagenDeInternetEImprimir("", 0, 216)
                                        .Feed(1)
                                        .EscribirTexto("<?php echo $nombreSistema ?>\n")
                                        .TextoSegunPaginaDeCodigos(2, "cp850", producto.mesa + "\n")
                                        .EscribirTexto("Fecha: " + (new Intl.DateTimeFormat("es-MX").format(new Date())) + "\n")
                                        .TextoSegunPaginaDeCodigos(2, "cp850", " Atendido por:" + producto.nombre + " " + producto.apellido + "\n")
                                        .Feed(1)
                                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
                                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
                                        .EscribirTexto(tabla)
                                        .EscribirTexto("------------------------------------------------\n")
                                        .Feed(3)
                                        .Corte(1)
                                        .Pulso(48, 60, 120)
                                        .imprimirEn("Xprinter1");
                                        //.imprimirEnImpresoraRemota("prueba1", "http://192.168.80.17:8000" + "/imprimir");
                                    if (respuesta === true) {
                                        $.ajax({
                                            url: 'views/ajax.php',
                                            type: 'GET',
                                            dataType: 'json',
                                            data: { respuestaPrint: print, id: id_mesa },
                                            success: async function (response) {
                                                if (response == true) {
                                                    alert("Impreso correctamente");
                                                }
                                            },
                                            error: function (xhr, status, error) {
                                                // Mostrar error si hay algún problema con la solicitud AJAX
                                                $('#valorEspecifico').text('Error: ' + error);
                                            }
                                        });

                                    } else {
                                        alert("Error: " + respuesta);
                                    }
                                }

                            },
                            error: function (xhr, status, error) {
                                // Mostrar error si hay algún problema con la solicitud AJAX
                                $('#valorEspecifico').text('Error: ' + error);
                            }
                        });
                    }
                    init();
                });

            },
            error: function (xhr, status, error) {
                // Mostrar error si hay algún problema con la solicitud AJAX
                $('#respuestaServidor').text('Error: ' + error);
            }
        });

    </script>
    <script>
        /*document.addEventListener("DOMContentLoaded", async () => {
            const URLPlugin = "http://localhost:8000"
            const $listaDeImpresoras = "prueba1",
                $btnImprimir = document.querySelector("#btnImprimir"),
                $btnObtenerImpresoras = "prueba1",
                $url = "http://192.168.80.25:8000",
                $mensaje = "hola";

            const obtenerImpresoras = async () => {
                const url = $url.value;
                if (!url) {
                    return alert("Escribe la URL");
                }
                for (let i = $listaDeImpresoras.options.length; i >= 0; i--) {
                    $listaDeImpresoras.remove(i);
                }
                const impresoras = await ConectorPluginV3.obtenerImpresorasRemotas(URLPlugin, url + "/impresoras");
                if (Array.isArray(impresoras)) {

                    for (const impresora of impresoras) {
                        $listaDeImpresoras.appendChild(Object.assign(document.createElement("option"), {
                            value: impresora,
                            text: impresora,
                        }));
                    }
                } else {
                    alert("Error obteniendo impresoras: " + impresoras);
                }
            };
            const init = async () => {

                $btnImprimir.addEventListener("click", () => {
                    const nombreImpresora = "prueba1";
                    if (!nombreImpresora) {
                        return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
                    }
                    imprimirHolaMundo(nombreImpresora);
                });
                $btnObtenerImpresoras.addEventListener("click", () => {
                    obtenerImpresoras();
                });
            }


            const imprimirHolaMundo = async (nombreImpresora) => {
                const mensaje = "Hola";
                const url = "http://192.168.80.25:8000";
                console.log(nombreImpresora);
                console.log(mensaje);
                console.log(url);
                if (!mensaje) {
                    return alert("Escribe un mensaje");
                }

                if (!url) {
                    return alert("Escribe la URL");
                }
                const conector = new ConectorPluginV3(URLPlugin);
                conector.Iniciar();
                conector.EscribirTexto(mensaje);
                conector.Feed(1);
                const respuesta = await conector
                    .imprimirEnImpresoraRemota(nombreImpresora, url + "/imprimir");
                if (respuesta === true) {
                    alert("Impreso correctamente");
                } else {
                    alert("Error: " + respuesta);
                }
            }
            init();
        });*/
    </script>
    <?php
}
?>