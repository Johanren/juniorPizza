<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "agregarNomina") {
        print '<script>
        swal("Hurra!!!", "Nomina Generada", "success");
    </script>';
    }
}
//rol
$rol = new ControladorRol();
$resRol = $rol->listarRol();
//activo
$activo = new ControladorActivo();
$resActivo = $activo->listarActivo();
//local
$activo = new ControladorLocal();
$resLocal = $activo->listarLocal();
///Usuario
$user = new ControladorUsuario();
$res = $user->listarUsuarioNomina();
if (isset($_GET['id_usuario'])) {
    print "<script>$(document).ready(function() {
        $('#nomina').modal('toggle')
    });</script>";
    $usuario = new ControladorUsuario();
    $resUsuario = $usuario->listarUsuarioId();
    $nomina = new ControladorNomina();
    $nomina->agregarPagoNomina();
}
?>
<div class="container">
    <div class="table-responsive">
        <table id="usuario" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Primer Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $key => $value) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $value['primer_nombre'] ?>
                        </td>
                        <td>
                            <?php echo $value['segundo_nombre'] ?>
                        </td>
                        <td>
                            <?php echo $value['primer_apellido'] ?>
                        </td>
                        <td>
                            <?php echo $value['segundo_apellido'] ?>
                        </td>
                        <td>
                            <?php echo $value['nombre_rol'] ?>
                        </td>
                        <td><a href="index.php?action=nomina&id_usuario=<?php echo $value['id_usuario'] ?>"><i
                                    class="fas fa-edit fa-lg"></i></a>
                            <?php
                            $nomina = new ControladorNomina();
                            $resNomina = $nomina->ConsultarNomina($value['id_usuario']);
                            foreach ($resNomina as $key => $value) {
                                ?>
                                <a href="index.php?action=nomina&id_nomina=<?php echo $value['id_nomina'] ?>"><i
                                        class="fas fa-print fa-lg"></i></a>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Primer Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- Modal Nomina -->
<div class="modal fade" id="nomina" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nomina</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState">Nombre</label>
                            <input type="text" name="nombre" class="form-control"
                                value="<?php echo $resUsuario[0]['primer_nombre'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">Apellido</label>
                            <input type="text" name="apellido" class="form-control"
                                value="<?php echo $resUsuario[0]['primer_apellido'] ?>">
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState">Cargo</label>
                            <input type="text" name="rol" class="form-control"
                                value="<?php echo $resUsuario[0]['nombre_rol'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">Pago</label>
                            <input type="text" name="pago" class="form-control" value="" placeholder="Valor a pagar">
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="agregarNomina" class="btn btn-primary">Agregar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_GET['id_nomina'])) {
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
                                        .EscribirTexto("Fecha: " + (new Intl.DateTimeFormat("es-MX").format(new Date())))
                                        .TextoSegunPaginaDeCodigos(2, "cp850", "Atendido por:" + producto.nombre + " " + producto.apellido + "\n")
                                        .Feed(1)
                                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
                                        .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
                                        .EscribirTexto(tabla)
                                        .EscribirTexto("------------------------------------------------\n")
                                        .Feed(3)
                                        .Corte(1)
                                        .Pulso(48, 60, 120)
                                        .imprimirEn("prueba1");
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
    <?php
}
?>