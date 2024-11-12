<?php
session_start();
//controlador
foreach (glob("../controllers/*.php") as $filename) {
    require_once $filename;
}

// Requiere todos los archivos en la carpeta 'models'
foreach (glob("../models/*.php") as $filename) {
    require_once $filename;
}

$local = new ControladorLocal();
$res = $local->consultarLocal($_SESSION['id_local']);
// generar_factura_pdf.php

require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datosFactura = $_POST['datosFactura'];

    // Configuración de los detalles del sistema
    $nombreSistema = $res[0]['nombre_local'];
    $nit = $res[0]['nit'];
    $telefono = $res[0]['telefono'];
    $direccion = $res[0]['direccion'];
    $logo = 'http://localhost/juniorPizza/views/img/mesas.png';  // Asegúrate de que la ruta sea accesible

    // Inicializar el objeto PDF
    $pdf = new TCPDF();
    $pdf->AddPage();

    // Ajustes del PDF
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Ferreinsumo Luna');
    $pdf->SetTitle('Factura Electrónica');
    $pdf->SetSubject('Factura');
    $pdf->SetKeywords('Factura, PDF, TCPDF');

    // Establecer fuente
    $pdf->SetFont('helvetica', '', 12);

    // Agregar el logo del sistema
    $pdf->Image($logo, 15, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

    // Título del sistema
    $pdf->Cell(0, 0, $nombreSistema, 0, 1, 'C', 0, '', 0);
    $pdf->Ln(4);  // Salto de línea

    // Datos del sistema (NIT, teléfono, dirección)
    $htmlEncabezado = '
    <h2 style="text-align:center;">' . $nombreSistema . '</h2>
    <p style="text-align:center;">
        <strong>NIT: </strong>' . $nit . '<br>
        <strong>Teléfono: </strong>' . $telefono . '<br>
        <strong>Dirección: </strong>' . $direccion . '
    </p>
    <hr>
    ';

    // Escribir la cabecera en el PDF
    $pdf->writeHTML($htmlEncabezado, true, false, true, false, '');

    // Crear la tabla con los datos de la factura
    $html = '<table border="1" cellspacing="3" cellpadding="4" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>';

    // Rellenar la tabla con los datos de la factura
    foreach ($datosFactura as $item) {
        $html .= '<tr>
                    <td>' . $item['codigo'] . '</td>
                    <td>' . $item['articulo'] . '</td>
                    <td>' . $item['precio'] . '</td>
                    <td>' . $item['cantidad'] . '</td>
                    <td>' . $item['total'] . '</td>
                  </tr>';
    }

    $html .= '</tbody></table>';

    // Escribir la tabla en el PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Ruta del archivo PDF
    $pdfFilePath = 'cotizacion.pdf';
    $pdf->Output(__DIR__ . '/' . $pdfFilePath, 'F');  // Guardar en el servidor

    // Enviar la respuesta con la URL del PDF
    echo json_encode(['urlPDF' => 'http://localhost/juniorPizza/views/' . $pdfFilePath]);
}
