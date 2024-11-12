<?php
$añoActual = date('Y');
$mesActual = date('m');

$inicioMes = new DateTime("$añoActual-$mesActual-01");

$finMes = clone $inicioMes;
$finMes->modify('last day of this month');
///////////////////////////////////////////////////
date_default_timezone_set('America/Mexico_City');

$venta = new ControladorVenta();
$res = $venta->informeVentaInicioFin();
//var_dump($res);
$totalsuma = 0;
$totalsumavalor = 0;
$base = 0;
?>
<div class="container">
    <form method="post" class="mt-3">
        <div class="row">
            <div class="col-sm-6">
                <h2>Informe Venta Eletronico</h2>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-3">
                <label for="">Fecha Inicio</label>
                <input type="date" class="form-control" id="inicio" name="inicio" value="<?php echo $inicioMes->format('Y-m-d'); ?>">
            </div>
            <div class="col-sm-3">
                <label for="">Fecha Fin</label>
                <input type="date" class="form-control" id="fin" name="fin" value="<?php echo $finMes->format('Y-m-d'); ?>">
            </div>
            <div class="col-sm-3">
                <button type="hidden" name="consultar" class="btn btn-primary">Buscar</button>
            </div>
            <div class="col-sm-3">
                <a href="#" id="informeVentaElectronico" name="excel"><i class="fas fa-file-excel fa-lg"></i></a>
            </div>
        </div>
    </form>
    <br>
    <div class="row">
        <div class="col">

            <div class="table-responsive">
                <table id="usuario" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Descripcion</th>
                            <th>Impuesto</th>
                            <th>Base</th>
                            <th>Valor Impuesto</th>
                            <th>Total Impuesto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['consultar'])) {
                            foreach ($res as $key => $value) {
                                //calcular porcentaje
                                $porjentaje = $value['base_impuesto'] / 100;
                                $impuesto = $porjentaje * $value['total_pago'];
                                //total impuesto
                                if ($value['base_impuesto'] == 0) {
                                    $total = 0;
                                } else {
                                    $total = $impuesto + $value['total_pago'];
                                }
                                //totrl impuesto suma
                                $totalsuma += $total;
                                $totalsumavalor += $impuesto;
                                $base += $value['total_pago'];
                        ?>
                                <tr>
                                    <td><?php echo $value['nombre_producto'] ?></td>
                                    <td><?php echo "0" . $value['numero_impuesto'] . $value['nombre_impusto'] ?></td>
                                    <td><?php echo number_format($value['total_pago'], 0) ?></td>
                                    <td><?php echo number_format($impuesto, 0) ?></td>
                                    <td><?php echo number_format($total, 0) ?></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                    <tbody>
                        <th>Total Impuesto</th>
                        <td></td>
                        <th><?php echo number_format($base, 0) ?></th>
                        <th><?php echo number_format($totalsumavalor, 0) ?></th>
                        <th><?php echo number_format($totalsuma, 0) ?></th>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
