<?php
$listarDomicilio = new ControladorDomicilioPedido();
$res = $listarDomicilio->listarPedidoDomicilio();

$listarPedido = new ControladorDomicilio();
$resPe = $listarPedido->listarPedido();
?>
<script>
    $(document).ready(function() {
        // Abre el modal `#reporte` al hacer clic en el botón `#reportes`
        $('#boton').on('click', function() {
            $('#modal').modal('toggle');
        });
        $('#clouse').on('click', function() {
            $('#modal').modal('hide');
        });
        $('#cerrar').on('click', function() {
            $('#modal').modal('hide');
        });
    })
</script>
<div class="container mt-5">
    <a href="domicilioPedido" class="btn btn-primary">Volver</a>
    <h1 style="text-align: center;">Pedido</h1>
    <div class="row">
        <div class="col-2">
            Numero De Domicilio: <?php echo $res[0]['id_domicilio_pedido'] ?>
        </div>
    </div>
    <?php
    if ($resPe[0]['nombre_estado'] != 'Entregado') {
        if ($resPe[0]['print'] == 0 || $resPe[0]['print'] == 2) {
    ?>
            <div class="row">
                <div class="col-2">
                    Tiempo duración de entrega: <?php
                                                // Establecer la zona horaria
                                                date_default_timezone_set('America/Bogota');

                                                // Hora específica para comparar
                                                $startTime = $resPe[0]['time'];

                                                // Convertir la hora específica a un objeto DateTime
                                                $startDateTime = new DateTime($startTime);

                                                // Obtener la hora actual
                                                $currentDateTime = new DateTime();

                                                // Calcular la diferencia
                                                $interval = $startDateTime->diff($currentDateTime);

                                                // Obtener los minutos totales pasados
                                                $hoursPassed = $interval->h;
                                                $minutesPassed = $interval->i;
                                                $totalMinutesPassed = ($hoursPassed * 60) + $minutesPassed;
                                                print $totalMinutesPassed . " Minutos";
                                                ?>

                </div>
            </div>
    <?php
        }
    }
    ?>
    <div class="row">
        <div class="col">
            <input type="text" class="form-control nom_local mt-5" value="<?php echo $res[0]['nombre_local'] ?>" id="local_1" disabled placeholder="Escriba el local para domicilio" required>
            <div class="form-row mt-3">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" value="<?php echo $res[0]['nombre'] ?>" name="nombre" disabled placeholder="Digite su nombre">
                </div>
                <div class="form-group col-md-6">
                    <input type="number" class="form-control" value="<?php echo $res[0]['telefono1'] ?>" name="tel1" disabled placeholder="Digite su Numero">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="number" class="form-control" name="tel2" value="<?php echo $res[0]['telefono2'] ?>" disabled placeholder="Digite su Numero (Opcional)">
                </div>
                <div class="form-group col-md-6">
                    <input name="direccion" id="" class="form-control" value="<?php echo $res[0]['direccion'] ?>" disabled placeholder="Su Dirección"></input>
                </div>
                <div class="form-group col-md-6">
                    <select name="metodo" id="metodo" disabled class="form-control" required>
                        <option value="">Seleccionar Metodo Pago...</option>
                        <option value="efectivo" <?php if ($res[0]['metodo_pago'] == 'efectivo') {
                                                        echo 'selected';
                                                    } ?>>Efectivo</option>
                        <option value="nequi" <?php if ($res[0]['metodo_pago'] == 'nequi') {
                                                    echo 'selected';
                                                } ?>>Nequi</option>
                        <option value="daviplata" <?php if ($res[0]['metodo_pago'] == 'daviplata') {
                                                        echo 'selected';
                                                    } ?>>Daviplata</option>
                        <option value="transfferencia" <?php if ($res[0]['metodo_pago'] == 'transfferencia') {
                                                            echo 'selected';
                                                        } ?>>Transferencia</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" value="Estado: <?php if ($resPe[0]['recogido'] == 1) {
                                                                                echo "Camino a Entregar";
                                                                            } else {
                                                                                if ($resPe[0]['p_cancelado'] == 1) {
                                                                                    echo "Cancelado";
                                                                                } else {
                                                                                    echo $resPe[0]['nombre_estado'];
                                                                                }
                                                                            }
                                                                            ?>" name="tel1" disabled placeholder="Digite su Numero">
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="pedidoProducto">
                    <?php
                    foreach ($resPe as $key => $value) {
                    ?>
                        <tr class="eliminar_1">
                            <td><input type="hidden" name="id_pedido[]" id="id_predido_1"><input type="text" name="producto[]" value="<?php echo $value['producto'] ?>" disabled class="form-control producto" required id="producto_1" placeholder="Producto"></td>
                            <th><textarea name="descripcion[]" id="descripcion_1" disabled class="form-control" cols="30" rows="1"><?php echo $value['descripcion'] ?></textarea></th>
                            <th><input type="hidden" name="precio[]" class="form-control valor" id="precio_1" placeholder="Precio"><input type="text" name="" value="<?php echo number_format($value['precio'], 0) ?>" disabled class="form-control valor" id="valor_1" placeholder="Precio" disabled></th>
                            <th><input type="text" name="cantidad[]" class="form-control cantidad" placeholder="Cantidad Pedido" id="cantidad_1" value="<?php echo $value['cantidad'] ?>" disabled required></th>
                            <th><input type="text" name="total" class="form-control resultado" id="resultado_1" value="<?php echo number_format($value['precio'] * $value['cantidad'], 0) ?>" disabled></th>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tbody>
                    <tr>
                        <td><input type="text" value="Domicilio" class="form-control" disabled></td>
                        <th><textarea name="" id="descripcion_1" class="form-control" cols="30" rows="1" disabled></textarea></th>
                        <th><input type="text" name="" class="form-control valor" id="valor_50" placeholder="Precio" value="5,000" disabled></th>
                        <th><input type="text" name="" class="form-control cantidad" placeholder="Cantidad Pedido" disabled id="cantidad_50" value="1" required></th>
                        <th><input type="text" name="total" class="form-control resultado" id="resultado_50" value="<?php echo number_format($total = 5000 * 1, 0) ?>" disabled></th>
                        <th></th>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><input type="text" class="form-control factura" name="total_Factura" id="total_1" disabled>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-3">
            <!-- Button trigger modal -->
            <a id="boton">Deseas Cancelar Tu Domicilio?</a>

            <!-- Modal -->
            <div class="modal fade" id="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cancelar Domicilio</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" id="clouse" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-warning" role="alert">
                                Si Tu Pedido Ya Fue Aceptado Y El Estado Esta En Preparación No Podra Ser Cancelado.
                            </div>
                            <form action="" method="post">
                                <input type="number" name="numero" class="form-control" placeholder="Digite Numero De Domicilio" required>
                                <button name="consult" class="btn btn-primary mt-3">Cancelar Domicilio</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cerrar" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col mt-5"></div>
    </div>
</div>
<link rel="stylesheet" href="views/css/tailwind.min.css">
<?php
if ($resPe[0]['nombre_estado'] == 'Atendido') {
?>
    <div class="REMOVE-THIS-ELEMENT-IF-YOU-ARE-USING-THIS-PAGE hidden treact-popup fixed inset-0 flex items-center justify-center" style="background-color: rgba(0,0,0,0.3);">
        <div class="max-w-lg p-8 sm:pb-4 bg-white rounded shadow-lg text-center sm:text-left">

            <h3 class="text-xl sm:text-2xl font-semibold mb-6 flex flex-col sm:flex-row items-center">
                <div class="bg-green-200 p-2 rounded-full flex items-center mb-4 sm:mb-0 sm:mr-2">
                    <svg class="text-green-800 inline-block w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
                Tu Pedido sera validado en pocos minutos te informaremos si fue aprobado o rechazado, por favor copia el numero de domicilio.
            </h3>
            <div class="mt-8 pt-8 sm:pt-4 border-t -mx-8 px-8 flex flex-col sm:flex-row justify-end leading-relaxed">
                <button class="close-treact-popup px-8 py-3 sm:py-2 rounded border border-gray-400 hover:bg-gray-200 transition duration-300">Cerrar</button>
            </div>
        </div>
    </div>
    <?php
} elseif ($resPe[0]['print'] == 0 || $resPe[0]['print'] == 2) {
    if ($resPe[0]['recogido'] == 1) {
    ?>
        <div class="REMOVE-THIS-ELEMENT-IF-YOU-ARE-USING-THIS-PAGE hidden treact-popup fixed inset-0 flex items-center justify-center" style="background-color: rgba(0,0,0,0.3);">
            <div class="max-w-lg p-8 sm:pb-4 bg-white rounded shadow-lg text-center sm:text-left">

                <h3 class="text-xl sm:text-2xl font-semibold mb-6 flex flex-col sm:flex-row items-center">
                    <div class="bg-green-200 p-2 rounded-full flex items-center mb-4 sm:mb-0 sm:mr-2">
                        <svg class="text-green-800 inline-block w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                    </div>
                    Tu Pedido Esta En Camino.
                </h3>
                <div class="mt-8 pt-8 sm:pt-4 border-t -mx-8 px-8 flex flex-col sm:flex-row justify-end leading-relaxed">
                    <button class="close-treact-popup px-8 py-3 sm:py-2 rounded border border-gray-400 hover:bg-gray-200 transition duration-300">Cerrar</button>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="REMOVE-THIS-ELEMENT-IF-YOU-ARE-USING-THIS-PAGE hidden treact-popup fixed inset-0 flex items-center justify-center" style="background-color: rgba(0,0,0,0.3);">
            <div class="max-w-lg p-8 sm:pb-4 bg-white rounded shadow-lg text-center sm:text-left">

                <h3 class="text-xl sm:text-2xl font-semibold mb-6 flex flex-col sm:flex-row items-center">
                    <div class="bg-green-200 p-2 rounded-full flex items-center mb-4 sm:mb-0 sm:mr-2">
                        <svg class="text-green-800 inline-block w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                        </svg>
                    </div>
                    Tu Pedido Fue Aprobado En 20 Min Tu Pedido Sera Enviado.
                </h3>
                <div class="mt-8 pt-8 sm:pt-4 border-t -mx-8 px-8 flex flex-col sm:flex-row justify-end leading-relaxed">
                    <button class="close-treact-popup px-8 py-3 sm:py-2 rounded border border-gray-400 hover:bg-gray-200 transition duration-300">Cerrar</button>
                </div>
            </div>
        </div>
    <?php
    }
} elseif ($resPe[0]['p_cancelado'] == 1) {
    ?>
    <div class="REMOVE-THIS-ELEMENT-IF-YOU-ARE-USING-THIS-PAGE hidden treact-popup fixed inset-0 flex items-center justify-center" style="background-color: rgba(0,0,0,0.3);">
        <div class="max-w-lg p-8 sm:pb-4 bg-white rounded shadow-lg text-center sm:text-left">

            <h3 class="text-xl sm:text-2xl font-semibold mb-6 flex flex-col sm:flex-row items-center">
                <div class="bg-green-200 p-2 rounded-full flex items-center mb-4 sm:mb-0 sm:mr-2">
                    <svg class="text-green-800 inline-block w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                </div>
                Tu Pedido Fue Cancelado Por Ti o Por El Local.
            </h3>
            <div class="mt-8 pt-8 sm:pt-4 border-t -mx-8 px-8 flex flex-col sm:flex-row justify-end leading-relaxed">
                <button class="close-treact-popup px-8 py-3 sm:py-2 rounded border border-gray-400 hover:bg-gray-200 transition duration-300">Cerrar</button>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if (isset($_POST['consult'])) {
    if ($resPe[0]['nombre_estado'] == 'Preparación') {
        print '<script>
    swal("Ops!", "Lo Sentimos No Podremos Cancelar Tu Pedido Ya Que Está En Preparación", "error");
</script>
';
    } else {
        $actualizar = new ControladorDomicilio();
        $actualizar->cancelarPedidoDomicilio($_POST['numero']);
    }
}
if ($resPe[0]['nombre_estado'] != 'Entregado') {
?>
    <script>
        function closeTreactPopup() {
            document.querySelector(".treact-popup").classList.add("hidden");
        }

        function openTreactPopup() {
            document.querySelector(".treact-popup").classList.remove("hidden");
        }
        document.querySelector(".close-treact-popup").addEventListener("click", closeTreactPopup);
        setTimeout(openTreactPopup, 3000)
    </script>
<?php
}
?>