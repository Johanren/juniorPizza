<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "        ") {
        print '<script>
        swal("Hurra!!!", "Pedido agregado exitosamente", "success");
    </script>';
    }
    if ($_GET['action'] == "actualizoMesa") {
        print '<script>
        swal("Hurra!!!", "Pedido cambio de mesa", "success");
    </script>';
    }
}
///Usuario
$user = new ControladorPedido();
$res = $user->listarPedidoMesa();
if (isset($_POST['actualizarMesa']) || isset($_POST['actualizarMesa_id'])) {
    //mesa
    $mesa = new ControladorMesa();
    $mesa->actualizarEstadoMesa('', '');
}
if (isset($_GET['id'])) {
    print "<script>$(document).ready(function() {
        $('#mesa').modal('toggle')
    });</script>";
    //mesa
    $mesa = new ControladorMesa();
    $resMesa = $mesa->buscarMesaId($_GET['id']);
    $estado = new ControladorEstadoMesa();
    $resEstado = $estado->listarEstadoMesa();
} elseif (isset($_GET['id_mesa'])) {
    print "<script>$(document).ready(function() {
        $('#mesa_id').modal('toggle')
    });</script>";
    //mesa
    $mesa = new ControladorMesa();
    $resMesa = $mesa->buscarMesaId($_GET['id_mesa']);
    $estado = new ControladorEstadoMesa();
    $resEstado = $estado->listarEstadoMesa();
}
?>
<div class="container mt-5">
    <br>
    <div class="table-responsive">
        <table id="usuario" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Mesa</th>
                    <th>Descripción Pedido</th>
                    <th>Mesero</th>
                    <th>Estado</th>
                    <th>Fecha ingreso</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $key => $value) {
                    ?>
                    <tr>
                        <td><?php echo $value['nombre_mesa'] ?></td>
                        <td>
                            <?php
                            $listarPedidoDescripcion = $user->listarPedidoMesaDescripcion($value['id_mesa'], $value['fecha_ingreso']);
                            foreach ($listarPedidoDescripcion as $key => $pedido) {
                                $conn = $key + 1;
                                print "<br>" . $conn . ". Producto: " . $pedido['producto'] . " <br> Descripcion: " . $pedido['descripcion'] . " <br> Cantidad: " . $pedido['cantidad'];
                            }
                            ?>
                        </td>
                        <td><?php echo $value['primer_nombre'] . " " . $value['primer_apellido'] ?></td>
                        <td><?php echo $value['nombre_estado'] ?></td>
                        <td><?php echo $value['fecha_ingreso'] ?></td>
                        <td><a
                                href="index.php?action=pedido&id=<?php echo $value['id_mesa'] ?>&mesa=<?php echo $value['nombre_mesa'] ?>&estado=<?php echo $value['id_estado_mesa'] ?>"><i
                                    class="fas fa-exchange-alt fa-lg"></i></a>
                            <a
                                href="index.php?action=pedido&id_mesa=<?php echo $value['id_mesa'] ?>&mesa=<?php echo $value['nombre_mesa'] ?>&estado=<?php echo $value['id_estado_mesa'] ?>&fecha=<?php echo $value['fecha_ingreso'] ?>"><i
                                    class="fas fa-edit fa-lg"></i></a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Mesa</th>
                    <th>Descripción Pedido</th>
                    <th>Mesero</th>
                    <th>Estado</th>
                    <th>Fecha ingreso</th>
                    <th>Accion</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- Modal Pedido -->
<div class="modal fade" id="mesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar <?php echo $_GET['mesa'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" class="form-control" value="<?php echo $_GET['id'] ?>" name="id_mesa">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState">Mesa</label>
                            <select id="inputState" name="mesa" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resMesa as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id_mesa'] ?>" <?php if ($value['id_mesa'] == $_GET['id']) {
                                           echo 'selected';
                                       } ?>>
                                        <?php echo $value['nombre_mesa'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Estado</label>
                            <select id="" name="estado" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resEstado as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id_estado_mesa'] ?>" <?php if ($value['id_estado_mesa'] == $_GET['estado']) {
                                           echo 'selected';
                                       } ?>>
                                        <?php echo $value['nombre_estado'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="actualizarMesa" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--Modal actualizar Mesa-->
<div class="modal fade" id="mesa_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar <?php echo $_GET['mesa'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" class="form-control" value="<?php echo $_GET['id_mesa'] ?>" name="id_mesa">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState">Mesa</label>
                            <select id="inputState" name="mesa" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resMesa as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id_mesa'] ?>" <?php if ($value['id_mesa'] == $_GET['id_mesa']) {
                                           echo 'selected';
                                       } ?>>
                                        <?php echo $value['nombre_mesa'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Estado</label>
                            <select id="" name="estado" class="form-control">
                                <option selected>Choose...</option>
                                <?php
                                foreach ($resEstado as $key => $value) {
                                    ?>
                                    <option value="<?php echo $value['id_estado_mesa'] ?>" <?php if ($value['id_estado_mesa'] == $_GET['estado']) {
                                           echo 'selected';
                                       } ?>>
                                        <?php echo $value['nombre_estado'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="actualizarMesa_id" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
            <?php
            if ($_SESSION['impresionPos'] == 'true') {
                ?>
                <div class="field">
                    <div class="">
                        <a href="#" id="<?php if ($_SESSION['impresionPos'] == 'true') { ?>btnImprimir<?php } ?>">print</a>
                    </div>
                </div>
                <?php
            } ?>
        </div>
    </div>
</div>
<?php
if ($_SESSION['impresionPos'] == 'true') {
    $nombreSistema = "Comanda de Cocina";
    $mesa = "1111";
    $usuario = "1111";
    ?>
    <script>

        var print = 0;
        var id_mesa = 0;

        $.ajax({
            url: 'views/ajax.php',
            type: 'get',
            dataType: 'json',
            data: { print: print },
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
                            data: { printUsuario: print },
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
                                        //.imprimirEnImpresoraRemota("prueba1", "http://192.168.80.25:8000" + "/imprimir");
                                    if (respuesta === true) {
                                        $.ajax({
                                            url: 'views/ajax.php',
                                            type: 'GET',
                                            dataType: 'json',
                                            data: { respuestaPrint: print, id: id_mesa},
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
    <?php
}
?>