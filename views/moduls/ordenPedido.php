<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "okOrden") {
        print '<script>
        swal("Hurra!!!", "Orden De Trabajo agregardo exitosamente", "success");
    </script>';
    }
    if ($_GET['action'] == "actuaOrden") {
        print '<script>
        swal("Hurra!!!", "Orden De Trabajo actualizado exitosamente", "success");
    </script>';
    }
    if ($_GET['action'] == "eliminarGasto") {
        print '<script>
        swal("Hurra!!!", "Gasto eliminado exitosamente", "success");
    </script>';
    }
}
$user = new ControladorVehiculo();
$res = $user->listarOrdenTrabajoPlaca();
if (isset($_GET['id_cliente_taller'])) {
    print "<script>$(document).ready(function() {
        $('#orden').modal('toggle')
    });</script>";
    $listar = $user->listarOrdenTrabajoPlacaId();
    $material = new ControladorMateriales();
    $listarmaterail = $material->listarMaterialesId();
}
?>
<div class="container mt-5">
    <form method="post" class="mt-3">
        <div class="row">
            <div class="col-sm-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-level-down-alt fa-lg"></i>
                </button>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3">
                <input type="text" class="form-control" id="plateNumber" placeholder="Número De Placa" name="placa">
            </div>
            <div class="col-sm-3">
                <button type="hidden" name="consultar" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>
    <br>
    <div class="table-responsive">
        <table id="usuario" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>N ° Orden</th>
                    <th>Placa</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['consultar'])) {
                    foreach ($res as $key => $value) {

                ?>
                        <tr>
                            <td>
                                <?php echo $value['id_cliente_taller'] ?>
                            </td>
                            <td>
                                <?php echo $value['placa'] ?>
                            </td>
                            <td>
                                <?php echo $value['fecha_entrada'] ?>
                            </td>
                            <td><a href="index.php?action=ordenPedido&id_cliente_taller=<?php echo $value['id_cliente_taller'] ?>"><i class="fas fa-print fa-lg"></i></a><a href="index.php?action=ordenPedidopdf&id_cliente_taller=<?php echo $value['id_cliente_taller'] ?>" target="_blank"><i class="fas fa-file-pdf fa-lg"></i></a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>N °Factura</th>
                    <th>Placa</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Orden Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <style>
                table {
                    width: 100%;
                    margin-bottom: 16px;
                    border-collapse: collapse;
                }

                th,
                td {
                    padding: 8px;
                    border: 1px solid #ccc;
                    text-align: center;
                }

                th {
                    background-color: #f2f2f2;
                }
            </style>
            <div class="modal-body">
                <form action="" method="post" id="workOrderForm">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="">
                                    <thead>
                                        <tr>
                                            <th>Carrera 8°#27-23</th>
                                        </tr>
                                        <tr>
                                            <th>BARRIO SANTANDER</th>
                                        </tr>
                                        <tr>
                                            <th>GIRARDOT-CUNDINAMARCA</th>
                                        </tr>
                                        <tr>
                                            <th>3184801952-3194318642</th>
                                        </tr>
                                        <tr>
                                            <th>tecnilubricentrocortes@gmail.com</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="col">
                            <table>
                                <thead>
                                    <tr>
                                        <th>
                                            <img src="views/img/logotecni.png" class="img-fluid" alt="...">
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <h4>ORDEN DE TRABAJO</h4>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>NOMBRE DEL CLIENTE</th>
                                            <th><input type="text" name="nombreCliente" class="form-control"></th>
                                            <th>NOMBRE DE LA EMPRESA</th>
                                            <th><input type="text" name="nombreempresa" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>TELEFONO DEL CLIENTE</th>
                                            <th><input type="text" name="telefonoCliente" class="form-control"></th>
                                            <th>RECIBIDO POR</th>
                                            <th><input type="text" name="recibidoPor" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>FECHA DE ENTRADA</th>
                                            <th><input type="datetime-local" name="fechaEntrada" class="form-control"></th>
                                            <th>FECHA DE SALIDA</th>
                                            <th><input type="datetime-local" name="fechaSalida" class="form-control"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>NIVEL DE COMBUSTIBLE</th>
                                            <th><input type="text" name="nivel" class="form-control"></th>
                                            <th>ESTADO GENERAL</th>
                                            <th><input type="text" name="estado" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>KILOMETRAJE</th>
                                            <th><input type="text" name="kilometro" class="form-control"></th>
                                            <th>MARCA</th>
                                            <th><input type="text" name="marca" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>PLACA</th>
                                            <th><input type="text" id="plateNumber" required name="placa" class="form-control"></th>
                                            <th>LINEA</th>
                                            <th><input type="text" name="linea" class="form-control"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ENGRASAR</th>
                                            <th><input type="text" name="grasa" class="form-control"></th>
                                            <th>CAMBIAR ACEITE</th>
                                            <th><input type="text" name="aceite" class="form-control"></th>
                                            <th>DESVARE</th>
                                            <th><input type="text" name="desvare" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>ELECTRICO</th>
                                            <th><input type="text" name="electrico" class="form-control"></th>
                                            <th>LLANTAS</th>
                                            <th><input type="text" name="llantas" class="form-control"></th>
                                            <th>LAVADO</th>
                                            <th><input type="text" name="lavado" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>FRENOS</th>
                                            <th><input type="text" name="frenos" class="form-control"></th>
                                            <th>SUSPENCION / AMORTIGUACION</th>
                                            <th><input type="text" name="supencion" class="form-control"></th>
                                            <th>MOTOR</th>
                                            <th><input type="text" name="motor" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>MUELLES</th>
                                            <th><input type="text" name="muelles" class="form-control"></th>
                                            <th>LATONERIA Y PINTURA</th>
                                            <th><input type="text" name="pintura" class="form-control"></th>
                                            <th>DIFERENCIAL (TRANSMICION)</th>
                                            <th><input type="text" name="diferencial" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>DIRECCIÓN</th>
                                            <th><input type="text" name="direccion" class="form-control"></th>
                                            <th>VIDRIOS GENERAL</th>
                                            <th><input type="text" name="vidrios" class="form-control"></th>
                                            <th>TAPIZADO</th>
                                            <th><input type="text" name="tapizado" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>LUCES</th>
                                            <th><input type="text" name="luces" class="form-control"></th>
                                            <th>SOLDADURA</th>
                                            <th><input type="text" name="soldadura" class="form-control"></th>
                                            <th>CAJA DE VELOCIDADES</th>
                                            <th><input type="text" name="caja" class="form-control"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>DESCRIPCION LABORAL</th>
                                        </tr>
                                        <tr>
                                            <th><textarea name="descripcion" cols="" rows="5" class="form-control" id=""></textarea></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead id="agregarMaterial">
                                        <tr>
                                            <th>MATERIALES UTILIZADOS</th>
                                            <th><a id="material" class="btn btn-primary">agregar</a></th>
                                        </tr>
                                        <tr>
                                            <th><input type="text" name="materiales[]" class="form-control nombre_articulo" id="nombre_1"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>OBSERVACION GENERAL Y/O PENDIENTES DEL VEHICULO</th>
                                        </tr>
                                        <tr>
                                            <th><textarea name="pendienevehiculo" cols="" rows="5" class="form-control" id=""></textarea></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label>Firma del Cliente:</label>
                            <input type="text" class="form-control" name="clinte">
                        </div>
                        <div class="col">
                            <label>Firma del Técnico:</label>
                            <input type="text" class="form-control" name="tecnico">
                        </div>
                        <div class="col">
                            <label>Firma de Entrega del Vehículo:</label>
                            <input type="text" class="form-control" name="entrega">
                        </div>
                    </div>
                    <button name="agregarOrden" class="btn btn-primary mt-5">Agregar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="orden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Orden Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <style>
                table {
                    width: 100%;
                    margin-bottom: 16px;
                    border-collapse: collapse;
                }

                th,
                td {
                    padding: 8px;
                    border: 1px solid #ccc;
                    text-align: center;
                }

                th {
                    background-color: #f2f2f2;
                }
            </style>
            <div class="modal-body">
                <form action="" method="post" id="workOrderForm">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="">
                                    <thead>
                                        <tr>
                                            <th>Carrera 8°#27-23</th>
                                        </tr>
                                        <tr>
                                            <th>BARRIO SANTANDER</th>
                                        </tr>
                                        <tr>
                                            <th>GIRARDOT-CUNDINAMARCA</th>
                                        </tr>
                                        <tr>
                                            <th>3184801952-3194318642</th>
                                        </tr>
                                        <tr>
                                            <th>tecnilubricentrocortes@gmail.com</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="col">
                            <table>
                                <thead>
                                    <tr>
                                        <th>
                                            <img src="views/img/logotecni.png" class="img-fluid" alt="...">
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <h4>ORDEN DE TRABAJO</h4>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>NOMBRE DEL CLIENTE</th>
                                            <th><input type="text" value="<?php echo $listar[0]['nombre_cliente'] ?>" name="nombreClienteEdit" class="form-control"></th>
                                            <th>NOMBRE DE LA EMPRESA</th>
                                            <th><input type="text" name="nombreempresaEdit" value="<?php echo $listar[0]['nombre_empresa'] ?>" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>TELEFONO DEL CLIENTE</th>
                                            <th><input type="text" name="telefonoClienteEdit" value="<?php echo $listar[0]['telefono_cliente'] ?>" class="form-control"></th>
                                            <th>RECIBIDO POR</th>
                                            <th><input type="text" name="recibidoPorEdit" value="<?php echo $listar[0]['recibido'] ?>" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>FECHA DE ENTRADA</th>
                                            <th><input type="datetime-local" name="fechaEntradaEdit" value="<?php echo $listar[0]['fecha_entrada'] ?>" class="form-control"></th>
                                            <th>FECHA DE SALIDA</th>
                                            <th><input type="datetime-local" name="fechaSalidaEdit" value="<?php echo $listar[0]['fecha_salida'] ?>" class="form-control"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>NIVEL DE COMBUSTIBLE</th>
                                            <th><input type="text" name="nivelEdit" value="<?php echo $listar[0]['nivel_conbusible'] ?>" class="form-control"></th>
                                            <th>ESTADO GENERAL</th>
                                            <th><input type="text" name="estadoEdit" value="<?php echo $listar[0]['estado_general'] ?>" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>KILOMETRAJE</th>
                                            <th><input type="text" name="kilometroEdit" value="<?php echo $listar[0]['kilometraje'] ?>" class="form-control"></th>
                                            <th>MARCA</th>
                                            <th><input type="text" name="marcaEdit" value="<?php echo $listar[0]['marca'] ?>" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>PLACA</th>
                                            <th><input type="text" id="plateNumber" value="<?php echo $listar[0]['placa'] ?>" required name="placaEdit" class="form-control"></th>
                                            <th>LINEA</th>
                                            <th><input type="text" name="lineaEdit" value="<?php echo $listar[0]['linea'] ?>" class="form-control"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ENGRASAR</th>
                                            <th><input type="text" name="grasaEdit" value="<?php echo $listar[0]['grasa'] ?>" class="form-control"></th>
                                            <th>CAMBIAR ACEITE</th>
                                            <th><input type="text" name="aceiteEdit" value="<?php echo $listar[0]['aceite'] ?>" class="form-control"></th>
                                            <th>DESVARE</th>
                                            <th><input type="text" name="desvareEdit" value="<?php echo $listar[0]['desvare'] ?>" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>ELECTRICO</th>
                                            <th><input type="text" name="electricoEdit" value="<?php echo $listar[0]['electrico'] ?>" class="form-control"></th>
                                            <th>LLANTAS</th>
                                            <th><input type="text" name="llantasEdit" value="<?php echo $listar[0]['llantas'] ?>" class="form-control"></th>
                                            <th>LAVADO</th>
                                            <th><input type="text" name="lavadoEdit" value="<?php echo $listar[0]['lavado'] ?>" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>FRENOS</th>
                                            <th><input type="text" name="frenosEdit" value="<?php echo $listar[0]['freno'] ?>" class="form-control"></th>
                                            <th>SUSPENCION / AMORTIGUACION</th>
                                            <th><input type="text" name="supencionEdit" value="<?php echo $listar[0]['suspencion'] ?>" class="form-control"></th>
                                            <th>MOTOR</th>
                                            <th><input type="text" name="motorEdit" value="<?php echo $listar[0]['motor'] ?>" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>MUELLES</th>
                                            <th><input type="text" name="muellesEdit" value="<?php echo $listar[0]['muelles'] ?>" class="form-control"></th>
                                            <th>LATONERIA Y PINTURA</th>
                                            <th><input type="text" name="pinturaEdit" value="<?php echo $listar[0]['pintura'] ?>" class="form-control"></th>
                                            <th>DIFERENCIAL (TRANSMICION)</th>
                                            <th><input type="text" name="diferencialEdit" value="<?php echo $listar[0]['diferencial'] ?>" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>DIRECCIÓN</th>
                                            <th><input type="text" name="direccionEdit" value="<?php echo $listar[0]['direccion'] ?>" class="form-control"></th>
                                            <th>VIDRIOS GENERAL</th>
                                            <th><input type="text" name="vidriosEdit" value="<?php echo $listar[0]['vidrio'] ?>" class="form-control"></th>
                                            <th>TAPIZADO</th>
                                            <th><input type="text" name="tapizadoEdit" value="<?php echo $listar[0]['tapizado'] ?>" class="form-control"></th>
                                        </tr>
                                        <tr>
                                            <th>LUCES</th>
                                            <th><input type="text" name="lucesEdit" value="<?php echo $listar[0]['luces'] ?>" class="form-control"></th>
                                            <th>SOLDADURA</th>
                                            <th><input type="text" name="soldaduraEdit" value="<?php echo $listar[0]['soldadura'] ?>" class="form-control"></th>
                                            <th>CAJA DE VELOCIDADES</th>
                                            <th><input type="text" name="cajaEdit" value="<?php echo $listar[0]['caja'] ?>" class="form-control"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>DESCRIPCION LABORAL</th>
                                        </tr>
                                        <tr>
                                            <th><textarea name="descripcionEdit" cols="" rows="5" class="form-control" id=""><?php echo $listar[0]['descripcion'] ?></textarea></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead id="agregarMaterialEdit">
                                        <tr>
                                            <th>MATERIALES UTILIZADOS</th>
                                            <th><a id="materialEdit" class="btn btn-primary">agregar</a></th>
                                        </tr>
                                        <?php
                                        foreach ($listarmaterail as $key => $value) {
                                        ?>
                                            <tr>
                                                <th><input type="hidden" name="id_material[]" value="<?php echo $value['id_material_vehiculo'] ?>"><input type="text" name="materialesEdit[]" value="<?php echo $value['material'] ?>" class="form-control nombre_articulo" id="nombre_<?php echo $key + 20 ?>"></th>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>OBSERVACION GENERAL Y/O PENDIENTES DEL VEHICULO</th>
                                        </tr>
                                        <tr>
                                            <th><textarea name="pendienevehiculoEdit" cols="" rows="5" class="form-control" id=""><?php echo $listar[0]['observacion'] ?></textarea></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label>Firma del Cliente:</label>
                            <input type="text" class="form-control" name="clinteEdit" value="<?php echo $listar[0]['firmaCliente'] ?>">
                        </div>
                        <div class="col">
                            <label>Firma del Técnico:</label>
                            <input type="text" class="form-control" name="tecnicoEdit" value="<?php echo $listar[0]['firmaTecnico'] ?>">
                        </div>
                        <div class="col">
                            <label>Firma de Entrega del Vehículo:</label>
                            <input type="text" class="form-control" name="entregaEdit" value="<?php echo $listar[0]['firmaVehiculo'] ?>">
                        </div>
                    </div>
                    <?php
                    if ($listar[0]['fecha_salida'] > 0) {
                    } else {
                    ?>
                        <button name="actualizarOrden" class="btn btn-primary mt-5">Actualizar</button>
                    <?php
                    }
                    ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<?php
$agregar = new ControladorClienteTaller();
$agregar->agregarOrdenTrabajoCliente();
?>