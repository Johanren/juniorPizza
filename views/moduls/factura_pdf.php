<?php
$local = new ControladorLocal();
$res = $local->consultarLocal($_SESSION['id_local']);
//
$agregarFactura = new ModeloFactura();
$resUltimoId = $agregarFactura->mostrarUltimoId();
if (isset($_GET['id_factura'])) {
    $id_factura = $_GET['id_factura'];
} else {
    $id_factura = $resUltimoId[0]['MAX(id_factura)'];
}
//
$mostrarVenta = new ControladorVenta();
$resVenta = $mostrarVenta->mostrarFacturaVenta($id_factura);
//
$mostrarVenta = new ModeloFactura();
$resFactura = $mostrarVenta->mostrarFacturaVentaModelo($id_factura);
$id_cliente = $resFactura[0]['id_cliente'];
//
$mostrarCliente = new ModeloCliente();
$resCliente = $mostrarCliente->mostrarClienteFacturaVentaModelo($id_cliente);

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
<div class="container">
    <div class="row">
        <div class="col">
            <div style="text-align: right;">
                <p>FACTURA N°<span id="nom_proeevedor">
                        <?php echo $resFactura[0]['id_factura'] ?>
                    </span></p>
            </div>
            <div style="text-align: right;">
                Fecha:
                <?php
                print $fechaActal;
                ?>
            </div>
            <div class="mt-3" style="text-align: center;">
                Sistema: <span id="nom_proeevedor">
                    <?php if ($res != null) {
                        echo $res[0]['nombre_local'];
                    } else {
                        echo "Inventario";
                    } ?>
                </span><br>
                Nit: <span id="nit_proeevedor">
                    <?php if ($res != null) {
                        echo $res[0]['nit'];
                    } else {
                        echo "1111";
                    } ?>
                </span><br>
                Telefono: <span id="tel_proeevedor">
                    <?php if ($res != null) {
                        echo $res[0]['telefono'];
                    } else {
                        echo "11111";
                    } ?>
                </span><br>
                Dirección: <span id="dir_proeevedor">
                    <?php if ($res != null) {
                        echo $res[0]['direccion'];
                    } else {
                        echo "NNNNN";
                    } ?>
                </span>
            </div>
        </div>
    </div>
    <table class="table mt-5">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody id="factura">
            <?php
            foreach ($resVenta as $key => $value) {
                ?>
                <tr>
                    <td>
                        <?php echo $value['codigo_producto'] ?>
                    </td>
                    <td>
                        <?php echo $value['nombre_producto'] ?>
                    </td>
                    <td>
                        <?php echo $value['valor_unitario'] ?>
                    </td>
                    <td>
                        <?php if ($value['cantidad'] > 0) {
                            echo $value['cantidad'];
                        } else {
                            echo $value['peso'] . " GR";
                        } ?>
                    </td>
                    <td>
                        <?php echo $value['precio_compra'] ?>
                    </td>
                </tr>
                <?php
            }

            ?>
        </tbody>
        <tbody>
            <tr>
                <th>Total</th>
                <th></th>
                <th></th>
                <th></th>
                <th>
                    <?php echo $resFactura[0]['total_factura'] ?>
                </th>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <th>Paga</th>
                <th>
                    <?php echo $resFactura[0]['efectivo'] ?>
                </th>
                <th></th>
                <th>Cambio</th>
                <th>
                    <?php echo $resFactura[0]['cambio'] ?>
                </th>
            </tr>
        </tbody>
    </table>
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
                    <input hidden id="maximaLongitudPrecio" value="8" class="input" type="number">
                </div>
            </div>
            <button id="Imprimir" class="btn btn-primary mt-2">Imprimir</button>
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
                    [
                        { contenido: "-", maximaLongitud: maximaLongitudNombre },
                        { contenido: "-", maximaLongitud: maximaLongitudCantidad },
                        { contenido: "-", maximaLongitud: maximaLongitudPrecio },
                        { contenido: "-", maximaLongitud: maximaLongitudPrecioTotal },
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
                <?php foreach ($resVenta as $key => $value) {
                    ?>{
                        nombre: "<?php echo $value['nombre_producto'] ?>",
                        cantidad: <?php if ($value['cantidad'] > 0) {
                            echo $value['cantidad'];
                        } else {
                            echo $value['peso'];
                        } ?>,
                        precio: <?php echo $value['valor_unitario'] ?>,
                        precioTotal: <?php echo $value['precio_compra'] ?>,
                    },
                    <?php
                }
                ?>
            ];
            // Comenzar a diseñar la tabla
            let tabla = obtenerLineaSeparadora() + "\n";


            const lineasEncabezado = tabularDatos([

                { contenido: "Nombre", maximaLongitud: maximaLongitudNombre },
                { contenido: "Cantidad", maximaLongitud: maximaLongitudCantidad },
                { contenido: "Precio", maximaLongitud: maximaLongitudPrecio },
                { contenido: "Total", maximaLongitud: maximaLongitudPrecioTotal },
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
                        { contenido: producto.precio.toString(), maximaLongitud: maximaLongitudPrecio },
                        { contenido: producto.precioTotal.toString(), maximaLongitud: maximaLongitudPrecio },
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
                .EscribirTexto("Fecha: " + (new Intl.DateTimeFormat("es-MX").format(new Date())))
                .Feed(1)
                .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
                .EscribirTexto("____________________\n")
                .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
                .EscribirTexto(tabla)
                .EscribirTexto("------------------------------------------------\n")
                .EscribirTexto("Total $<?php echo $resFactura[0]['total_factura'] ?>\n")
                .EscribirTexto("------------------------------------------------\n")
                .EscribirTexto("Pago <?php echo $resFactura[0]['efectivo'] ?>   Cambio: <?php echo $resFactura[0]['cambio'] ?>\n")
                .EscribirTexto("------------------------------------------------\n")
                .EscribirTexto("Cliente Final\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Nombre y apellido: <?php echo $resCliente[0]['primer_nombre'] . " " . $resCliente[0]['primer_apellido'] ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "CC: <?php echo $resCliente[0]['numero_cc'] ?>\n")
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