<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "agregarPedidor") {
        print '<script>
        swal("Hurra!!!", "Pedido agregado exitosamente", "success");
    </script>';
    }
}
///Usuario
$user = new ControladorPedido();
$res = $user->listarPedidoMesa();
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
                                $listarPedidoDescripcion  = $user->listarPedidoMesaDescripcion($value['id_mesa'], $value['fecha_ingreso']);
                                foreach ($listarPedidoDescripcion as $key => $pedido) {
                                    $conn = $key+1;
                                    print "<br>".$conn.". Producto: ".$pedido['producto']. " <br> Descripcion: ".$pedido['descripcion']." <br> Cantidad: ".$pedido['cantidad'];
                                }
                            ?>
                        </td>
                        <td><?php echo $value['primer_nombre'] . " " . $value['primer_apellido'] ?></td>
                        <td><?php echo $value['nombre_estado'] ?></td>
                        <td><?php echo $value['fecha_ingreso'] ?></td>
                        <td> </td>
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