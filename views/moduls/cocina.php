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
                        <p>Atendido por: <span class="chef"><?php echo $value['primer_nombre'] . " " . $value['primer_apellido'] ?></span>
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
                        <a href="index.php?action=cocina&estado=<?php print $pedido['id_mesa'] ?>&fecha=<?php print $pedido['fecha_ingreso'] ?>"><i class="fas fa-hand-point-right fa-lg"></i></a>
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
                    <input hidden id="maximaLongitudCantidad" value="6" class="input" type="number">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el precio</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudPrecio" value="16" class="input" type="number">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el precio</label>-->
                <div class="control">
                    <input hidden id="id_mesa" value="<?php if (isset($_GET['id_mesa'])) {
                                                            echo $_GET['id_mesa'];
                                                        } ?>" class="input" type="text">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el precio</label>-->
                <div class="control">
                    <input hidden id="fecha" value="<?php if (isset($_GET['fecha'])) {
                                                        echo $_GET['fecha'];
                                                    } ?>" class="input" type="text">
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
        let id_mesa = $('#id_mesa').val();
        var fecha = $('#fecha').val();

        document.addEventListener("DOMContentLoaded", async () => {
            $.ajax({
                url: 'views/ajax.php',
                type: 'get',
                dataType: 'json',
                data: {
                    id_mesa: id_mesa,
                    fecha: fecha
                },
                success: function(response) {

                    /* ============================
                       FUNCIONES PARA TABULAR DATOS
                    ============================ */
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
                        const [arreglos, mayor] = dividirCadenasYEncontrarMayorConteoDeBloques(cadenas);
                        let indice = 0;
                        const lineas = [];
                        while (indice < mayor) {
                            let linea = "";
                            for (const contenido of arreglos) {
                                let cadena = "";
                                if (indice < contenido.separadas.length) {
                                    cadena = contenido.separadas[indice];
                                }
                                if (cadena.length < contenido.maximaLongitud) {
                                    cadena = cadena + relleno.repeat(contenido.maximaLongitud - cadena.length);
                                }
                                linea += cadena + separadorColumnas;
                            }
                            lineas.push(linea);
                            indice++;
                        }
                        return lineas;
                    }

                    const URLPlugin = "http://localhost:8000";
                    const $btnImprimir = document.querySelector("#btnImprimir"),
                        $separador = document.querySelector("#separador"),
                        $relleno = document.querySelector("#relleno"),
                        $maximaLongitudNombre = document.querySelector("#maximaLongitudNombre"),
                        $maximaLongitudCantidad = document.querySelector("#maximaLongitudCantidad"),
                        $maximaLongitudPrecio = document.querySelector("#maximaLongitudPrecio");

                    const init = async () => {
                        $btnImprimir.addEventListener("click", () => {
                            const nombreImpresora = "cocina";
                            if (!nombreImpresora) {
                                return alert("Seleccione una impresora.");
                            }
                            imprimirTabla("cocina");
                        });
                    }

                    /* ============================
                       FUNCIÓN PRINCIPAL DE IMPRESIÓN
                    ============================ */
                    const imprimirTabla = async (nombreImpresora) => {

                        const maximaLongitudNombre = parseInt($maximaLongitudNombre.value),
                            maximaLongitudCantidad = parseInt($maximaLongitudCantidad.value),
                            maximaLongitudPrecio = parseInt($maximaLongitudPrecio.value),
                            relleno = $relleno.value,
                            separadorColumnas = $separador.value;

                        const obtenerLineaSeparadora = () => {
                            const lineas = tabularDatos(
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
                                ],
                                "-",
                                "+"
                            );
                            return lineas.length > 0 ? lineas[0] : "";
                        }

                        const listaDeProductos = response;

                        let tabla = obtenerLineaSeparadora() + "\n";
                        const lineasEncabezado = tabularDatos(
                            [{
                                    contenido: "Nombre",
                                    maximaLongitud: maximaLongitudNombre
                                },
                                {
                                    contenido: "Cantidad",
                                    maximaLongitud: maximaLongitudCantidad
                                },
                                {
                                    contenido: "Descripcion",
                                    maximaLongitud: maximaLongitudPrecio
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
                                        contenido: producto.descripcion.toString(),
                                        maximaLongitud: maximaLongitudPrecio
                                    },
                                ],
                                relleno,
                                separadorColumnas
                            );
                            for (const linea of lineas) tabla += linea + "\n";
                            tabla += obtenerLineaSeparadora() + "\n";
                        }

                        console.log(tabla);

                        const conector = new ConectorPluginV3(URLPlugin);

                        /* ============================
                           ÚLTIMO AJAX PARA PEDIDOS
                        ============================ */
                        $.ajax({
                            url: 'views/ajax.php',
                            type: 'GET',
                            dataType: 'json',
                            data: {
                                id_mesa: id_mesa,
                                fechaActual: fecha
                            },
                            success: async function(response) {
                                const listarPedido = response;

                                /* ============================
                                   IMPRIME CADA PRODUCTO
                                ============================ */
                                for (const producto of listarPedido) {

                                    await conector
                                        .Iniciar()
                                        .DeshabilitarElModoDeCaracteresChinos()
                                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO)
                                        .Feed(1)
                                        .EscribirTexto("<?php echo $nombreSistema ?>\n")
                                        .TextoSegunPaginaDeCodigos(2, "cp850", producto.mesa + "\n")
                                        .EscribirTexto("Fecha: " + (new Intl.DateTimeFormat("es-MX").format(new Date())) + "\n")
                                        .TextoSegunPaginaDeCodigos(2, "cp850", "Atendido por:" + producto.nombre + " " + producto.apellido + "\n")
                                        .Feed(1)
                                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
                                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
                                        .EscribirTexto(tabla)
                                        .EscribirTexto("------------------------------------------------\n")
                                        .Feed(3)
                                        .Corte(1)
                                        .Pulso(48, 60, 120)
                                        .imprimirEn("cocina");
                                }

                                /* ============================
                                   AQUÍ SE ACTUALIZA EL PRINT
                                   SOLO UNA VEZ
                                ============================ */
                                $.ajax({
                                    url: 'views/ajax.php',
                                    type: 'GET',
                                    dataType: 'json',
                                    data: {
                                        respuestaPrint: print,
                                        id: id_mesa
                                    },
                                    success: function(r) {
                                        window.location = "cocina"; // 🔥 SOLO UNA RECARGA
                                    },
                                    error: function() {
                                        window.location = "cocina"; // 🔥 EN CASO DE ERROR TAMBIÉN RECARGA
                                    }
                                });

                            }
                        });

                    }

                    init();
                }
            });
        });
    </script>

<?php
}
?>

<script>
    setInterval(() => location.reload(), 5000); // recarga cada 5 segundos
</script>