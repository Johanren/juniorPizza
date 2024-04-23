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
                                <a <?php if (isset($_GET['id_nomina'])) {
                                    echo "id='btnImprimir' href='#'";
                                } else {

                                    ?>
                                        href="index.php?action=nomina&id_nomina=<?php echo $value['id_nomina'] ?>" <?php
                                }
                                ?>><i
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
                <h5 class="modal-title" id="exampleModalLabel" style="font-weight: 500; color: black;">NOMINA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState" style="font-weight: 500; color: black;">Nombre</label>
                            <input type="text" name="nombre" class="form-control"
                                value="<?php echo $resUsuario[0]['primer_nombre'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState" style="font-weight: 500; color: black;">Apellido</label>
                            <input type="text" name="apellido" class="form-control"
                                value="<?php echo $resUsuario[0]['primer_apellido'] ?>">
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState" style="font-weight: 500; color: black;">Dias Trabajado</label>
                            <input type="text" name="dia" class="form-control" id="dia" value=""
                                placeholder="Dias trabajado">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState" style="font-weight: 500; color: black;">Pago Por Dia</label>
                            <input type="text" name="" class="form-control" id="pago" value=""
                                placeholder="Valor por dia">
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputState" style="font-weight: 500; color: black;">Pago Total</label>
                            <input type="text" name="pago" class="form-control" id="pago_dia" value=""
                                placeholder="Valor a pagar">
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState" style="font-weight: 500; color: black;">Cargo</label>
                            <input type="text" name="rol" class="form-control"
                                value="<?php echo $resUsuario[0]['nombre_rol'] ?>">
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
                    <input hidden id="maximaLongitudCantidad" value="8" class="input" type="number">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Máxima longitud para el precio</label>-->
                <div class="control">
                    <input hidden id="maximaLongitudPrecio" value="20" class="input" type="number">
                    <input hidden id="id_nomina" value="<?php echo $_GET['id_nomina'] ?>" class="input" type="number">
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_GET['id_nomina'])) {
    $local = new ControladorLocal();
    $res = $local->consultarLocal($_SESSION['id_local']);

    date_default_timezone_set('America/Mexico_City');
    $fechaActal = date('Y-m-d');
    if ($res != null) {
        $nombreSistema = $res[0]['nombre_local'];
        $nit = $res[0]['nit'];
        $tel = $res[0]['telefono'];
        $dire = $res[0]['direccion'];
    } else {
        $nombreSistema = "Inventario";
        $nit = "1111";
        $tel = "1111";
        $dire = "NNNN";
    }
    ?>
    <script>
        var id_nomina = $('#id_nomina').val();

        $.ajax({
            url: 'views/ajax.php',
            type: 'get',
            dataType: 'json',
            data: { id_nomina: id_nomina },
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
                            { contenido: "Cantidad Dias", maximaLongitud: maximaLongitudCantidad },
                            { contenido: "Total Pago", maximaLongitud: maximaLongitudPrecio },
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
                                    { contenido: producto.dias.toString(), maximaLongitud: maximaLongitudCantidad },
                                    { contenido: producto.ValorTotal.toString(), maximaLongitud: maximaLongitudPrecio },
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
                            //.DescargarImagenDeInternetEImprimir("", 0, 216)
                            .Feed(1)
                            .EscribirTexto("<?php echo $nombreSistema ?>\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Nit: <?php echo $nit ?>\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Teléfono: <?php echo $tel ?>\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Direccion: <?php echo $dire ?>\n")
                            .EscribirTexto("Fecha: " + (new Intl.DateTimeFormat("es-MX").format(new Date())))
                            .Feed(1)
                            .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
                            .EscribirTexto(tabla)
                            .EscribirTexto("------------------------------------------------\n")
                            .EscribirTexto("\n")
                            .EscribirTexto("\n")
                            .EscribirTexto("Firma Gerente-----------------------------------\n")
                            .EscribirTexto("\n")
                            .EscribirTexto("\n")
                            .EscribirTexto("Firma Empleado-----------------------------------\n")
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