<?php
$listar = new ControladorDomicilioPedido();
$res = $listar->listarPedidoDomicilioTabla();

$listarPedido = new ControladorDomicilio();
?>
<div class="container mt-5">
    <br>
    <div class="table-responsive">
        <table id="usuario" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th># Domicilio</th>
                    <th>Cliente</th>
                    <th>Descripción Pedido</th>
                    <th>Telefonos</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Fecha ingreso</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $key => $value) {
                ?>
                    <tr>
                        <td><?php echo $value['id_domicilio_pedido'] ?></td>
                        <td><?php echo $value['nombre'] ?></td>
                        <td>
                            <?php
                            $listarPedidoDescripcion = $listarPedido->listarPedidoTabla($value['id_domicilio_pedido']);
                            foreach ($listarPedidoDescripcion as $key => $pedido) {
                                // Establecer la zona horaria
                                date_default_timezone_set('America/Bogota');

                                // Hora específica para comparar
                                $startTime = $listarPedidoDescripcion[0]['time'];

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
                                $conn = $key + 1;
                                print "<br>" . $conn . ". Producto: " . $pedido['producto'] . " <br> Descripcion: " . $pedido['descripcion'] . " <br> Cantidad: " . $pedido['cantidad'];
                            }
                            ?>
                        </td>
                        <td>Primer Número:<a href="tel:+57<?php print $value['telefono1'] ?>">(+57) <?php print $value['telefono1'] ?></a> <br> Segundo Número: <a href="tel:+57<?php print $value['telefono2'] ?>">(+57) <?php print $value['telefono2'] ?></a></td>
                        <td><iframe id="gmap_canvas"
                                src="https://maps.google.com/maps?q=<?php echo urlencode($value['direccion']); ?>&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                                style="border:0; width: 100%; height: 100%;"></iframe></td>
                        <td><?php if ($listarPedidoDescripcion[0]['recogido'] == 1) {
                                echo "Camino a Entregar";
                            } else {
                                echo $listarPedidoDescripcion[0]['nombre_estado'];
                            } ?></td>
                        <td><?php
                            $listarPedidoDescripcion = $listarPedido->listarPedidoTabla($value['id_domicilio_pedido']);
                            $total = 0;
                            foreach ($listarPedidoDescripcion as $key => $pedido) {
                                $suma = $pedido['precio'] * $pedido['cantidad']; // Asignar el precio del pedido
                                $total += $suma; // Acumular el precio en el total
                            }
                            if ($listarPedidoDescripcion[0]['pago'] == 0) {
                                $pago = "No Pago";
                            } else {
                                $pago = "Pago";
                            }
                            print "<strong class='mt-2'>Total: " . number_format($total, 0) . "</strong> <strong class='mt-2'>Domicilio: 5,000 </strong> <strong class='mt-2'>Total a pagar: " . number_format($total + 5000, 0) . "</strong> <strong class='mt-2'>Metodo Pago: " . $res[0]['metodo_pago'] . "</strong> <strong class='mt-2'>Estado Pago: " . $pago . "</strong>";
                            ?></td>
                        <td><?php echo $listarPedidoDescripcion[0]['fecha_ingreso'] . "<br>" . $listarPedidoDescripcion[0]['time'] . "<br> Tiempo De Espera: " . $totalMinutesPassed . " Minutos" ?></td>
                        <td><?php if ($listarPedidoDescripcion[0]['print'] == 0 || $listarPedidoDescripcion[0]['print'] == 2) {
                            } else {
                                if ($_SESSION['rol'] != 'Domiciliario') { ?><button class="btn btn-success" onclick="actualizarPrint(<?php echo $value['id_domicilio_pedido']; ?>)">Aprobar</button><?php }
                                                                                                                                                                                            }
                                                                                                                                                                                            if ($_SESSION['rol'] != 'Domiciliario') { ?><button class="btn btn-danger mt-2" onclick="actualizarCancelado(<?php echo $value['id_domicilio_pedido']; ?>)">Cancelar</button><?php
                                                                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                                                                        if ($listarPedidoDescripcion[0]['print'] == 2) {
                                                                                                                                                                                                                                                                                                                                                                            if ($listarPedidoDescripcion[0]['recogido'] != 1) { ?><button class="btn btn-success mt-2" onclick="actualizarDomiciliario(<?php echo $value['id_domicilio_pedido']; ?>)">Llevar</button><?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            if ($listarPedidoDescripcion[0]['recogido'] == 1) { ?><button class="btn btn-success mt-2" onclick="actualizarEntregado(<?php echo $value['id_domicilio_pedido']; ?>)">Entregado</button><?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Cliente</th>
                    <th>Descripción Pedido</th>
                    <th>Telefonos</th>
                    <th>Dirección</th>
                    <th>Estado</th>
                    <th>Total</th>
                    <th>Fecha ingreso</th>
                    <th>Accion</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>