<?php
$user = new ControladorVehiculo();
$res = $user->listarOrdenTrabajoPlaca();
if (isset($_GET['id_cliente_taller'])) {
    $listar = $user->listarOrdenTrabajoPlacaId();
    $material = new ControladorMateriales();
    $listarmaterail = $material->listarMaterialesId();
}
?>
<style>
    ul {
        display: none !important;
    }

    nav {
        display: none !important;
    }

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
<div class="row">
    <div class="col">
        <table>
            <thead>
                <tr>
                    <th>
                        <img src="http://<?php echo $_SERVER['HTTP_HOST'] ?>/juniorPizza/views/img/logotecni.png" class="img-fluid" alt="...">
                    </th>
                </tr>
            </thead>
        </table>
    </div>
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
                        <th><?php echo $listar[0]['nombre_cliente'] ?></th>
                        <th>NOMBRE DE LA EMPRESA</th>
                        <th><?php echo $listar[0]['nombre_empresa'] ?></th>
                    </tr>
                    <tr>
                        <th>TELEFONO DEL CLIENTE</th>
                        <th><?php echo $listar[0]['telefono_cliente'] ?></th>
                        <th>RECIBIDO POR</th>
                        <th><?php echo $listar[0]['recibido'] ?></th>
                    </tr>
                    <tr>
                        <th>FECHA DE ENTRADA</th>
                        <th><?php echo $listar[0]['fecha_entrada'] ?></th>
                        <th>FECHA DE SALIDA</th>
                        <th><?php echo $listar[0]['fecha_salida'] ?></th>
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
                        <th><?php echo $listar[0]['nivel_conbusible'] ?></th>
                        <th>ESTADO GENERAL</th>
                        <th><?php echo $listar[0]['estado_general'] ?></th>
                    </tr>
                    <tr>
                        <th>KILOMETRAJE</th>
                        <th><?php echo $listar[0]['kilometraje'] ?></th>
                        <th>MARCA</th>
                        <th><?php echo $listar[0]['marca'] ?></th>
                    </tr>
                    <tr>
                        <th>PLACA</th>
                        <th><?php echo $listar[0]['placa'] ?></th>
                        <th>LINEA</th>
                        <th><?php echo $listar[0]['linea'] ?></th>
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
                        <th><?php echo $listar[0]['grasa'] ?></th>
                        <th>CAMBIAR ACEITE</th>
                        <th><?php echo $listar[0]['aceite'] ?></th>
                    </tr>
                    <tr>
                        <th>DESVARE</th>
                        <th><?php echo $listar[0]['desvare'] ?></th>
                        <th>LAVADO</th>
                        <th><?php echo $listar[0]['lavado'] ?></th>
                    </tr>
                    <tr>
                        <th>ELECTRICO</th>
                        <th><?php echo $listar[0]['electrico'] ?></th>
                        <th>LLANTAS</th>
                        <th><?php echo $listar[0]['llantas'] ?></th>
                    </tr>
                    <tr>
                        <th>FRENOS</th>
                        <th><?php echo $listar[0]['freno'] ?></th>
                        <th>MUELLES</th>
                        <th><?php echo $listar[0]['muelles'] ?></th>
                    </tr>
                    <tr>
                        <th>SUSPENCION / AMORTIGUACION</th>
                        <th><?php echo $listar[0]['suspencion'] ?></th>
                        <th>MOTOR</th>
                        <th><?php echo $listar[0]['motor'] ?></th>
                    </tr>
                    <tr>
                        <th>LATONERIA Y PINTURA</th>
                        <th><?php echo $listar[0]['pintura'] ?></th>
                        <th>DIFERENCIAL (TRANSMICION)</th>
                        <th><?php echo $listar[0]['diferencial'] ?></th>
                    </tr>
                    <tr>
                        <th>DIRECCIÓN</th>
                        <th><?php echo $listar[0]['direccion'] ?></th>
                        <th>LUCES</th>
                        <th><?php echo $listar[0]['luces'] ?></th>
                    </tr>
                    <tr>
                        <th>VIDRIOS GENERAL</th>
                        <th><?php echo $listar[0]['vidrio'] ?></th>
                        <th>TAPIZADO</th>
                        <th><?php echo $listar[0]['tapizado'] ?></th>
                    </tr>
                    <tr>
                        <th>SOLDADURA</th>
                        <th><?php echo $listar[0]['soldadura'] ?></th>
                        <th>CAJA DE VELOCIDADES</th>
                        <th><?php echo $listar[0]['caja'] ?></th>
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
                        <th><?php echo $listar[0]['descripcion'] ?></th>
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
                    </tr>
                    <?php
                    foreach ($listarmaterail as $key => $value) {
                    ?>
                        <tr>
                            <th><?php echo $value['material'] ?></th>
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
                        <th><?php echo $listar[0]['observacion'] ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col">
        <label>Firma del Cliente:</label>
        <input type="text" class="form-control" name="clinteEdit">
    </div>
    <div class="col">
        <label>Firma del Técnico:</label>
        <input type="text" class="form-control" name="tecnicoEdit">
    </div>
    <div class="col">
        <label>Firma de Entrega del Vehículo:</label>
        <input type="text" class="form-control" name="entregaEdit">
    </div>
</div>
<?php
// somewhere early in your project's loading, require the Composer autoloader
// see: http://getcomposer.org/doc/00-intro.md
require 'vendor/autoload.php';
// include autoloader
require_once 'dompdf/autoload.inc.php';

$html = ob_get_clean();


//echo $html;
// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('letter');
$dompdf->setPaper('', 'Arial');

// Render the HTML as PDF
$dompdf->render();

/*$canvas = $dompdf->getCanvas();

$w = $canvas->get_width();
$h = $canvas->get_height();

$imageURL = 'views/img/logotecni.png';
$imgWidth = 200;
$imgHeight = 200;

$canvas->set_opacity(.3);

$x = (($w - $imgWidth) / 2);
$y = (($h - $imgHeight) / 2);

$canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight);*/

// Output the generated PDF to Browser
$dompdf->stream("OrdenPedido.pdf", array("Attachment" => false));
?>