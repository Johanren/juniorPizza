<?php
$añoActual = date('Y');
$mesActual = date('m');

$inicioMes = new DateTime("$añoActual-$mesActual-01");

$finMes = clone $inicioMes;
$finMes->modify('last day of this month');
///////////////////////////////////////////////////
date_default_timezone_set('America/Mexico_City');

$venta = new ControladorFactura();
$res = $venta->listarFacturaElctronica();
//ar_dump($res);
$totalsuma = 0;
$totalsumavalor = 0;
$base = 0;
?>
<div class="container">
    <form method="post" class="mt-3">
        <div class="row">
            <div class="col-sm-6">
                <h2>Factruas Electronicas</h2>
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
        </div>
    </form>
    <br>
    <div class="row">
        <div class="col">

            <div class="table-responsive">
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th>Numero factura</th>
                            <th>Cedula cliente</th>
                            <th>Nombre cliente</th>
                            <th>Fecha factura</th>
                            <th>Total Compra</th>
                            <th>Imprimir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['consultar'])) {
                            foreach ($res as $key => $value) {
                        ?>
                                <tr>
                                    <td>
                                        <?php echo $value['id_factura'] ?>
                                    </td>
                                    <td>
                                        <?php echo $value['numero_cc'] ?>
                                    </td>
                                    <td>
                                        <?php echo $value['primer_nombre'] . " " . $value['primer_apellido'] ?>
                                    </td>
                                    <td>
                                        <?php echo $value['fecha_factura'] ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($value['total_factura'], 0) ?>
                                    </td>
                                    <td><a href="index.php?action=factura_pdf&id_factura=<?php echo $value['id_factura'] ?>&factura=false"><button class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-receipt-cutoff" viewBox="0 0 16 16">
                                                <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5M11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z" />
                                                <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118z" />
                                            </svg></button></a></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>