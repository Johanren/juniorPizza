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
$mostrarPropina = new ControladorPropina();
$resPropina = $mostrarPropina->listarPropina($id_factura);
//
$mostrarVenta = new ModeloFactura();
$resFactura = $mostrarVenta->mostrarFacturaVentaModelo($id_factura);
$id_cliente = $resFactura[0]['id_cliente'];
//
$mostrarCliente = new ModeloCliente();
$resCliente = $mostrarCliente->mostrarClienteFacturaVentaModelo($id_cliente);

date_default_timezone_set('America/Mexico_City');
$fecha = date('Y-m-d') . " " . date('H:i:s');
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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
if (isset($_SESSION['factura'])) {
    if ($_SESSION['factura'] == 'true') {
        if (isset($_GET['factura'])) {
            if (isset($_POST['enviar_correo'])) {
                $añoActual = date('Y');
                $mesActual = date('m');

                // Crear un objeto DateTime para el primer día del mes actual
                $inicioMes = new DateTime("$añoActual-$mesActual-01");

                // Clonar el objeto para obtener la fecha de fin y modificarlo al último día del mes
                $finMes = clone $inicioMes;
                $finMes->modify('last day of this month');
                ///////////////////////////////////////////////////
                date_default_timezone_set('America/Mexico_City');
                $claveTecnica = "fc8eac422eba16e22ffd8c6f94b3f40a6e38162c"; //esta clave es generada por la DIAn
                $InvoiceAuthorization = "18760000001"; //numeor de autorizacion por la dian
                $StartDate = "2019-01-19"; //fecha inico de factura por DIAN
                $EndDate = "2030-01-19"; // Fecha fin de factura por DIAN
                $Prefix = "SETG"; //Prefijo dado por DINA
                $From = "980000000"; // Inicio de facturas por DIAN
                $To = "985000000"; // Fin de facturas por Dian
                $companyNit = "11206481"; // Nit dado por DIAN
                $SoftwareID = "fa326ca7-c1f8-40d3-a6fc-24d7c1040607"; //ID software dado por DIAN
                $ping = "20191"; //Ping dado por DIan
                $AuthorizationProviderID = "800197268"; //Autorización Provider dado por DIAN


                $CustomizationID = "10"; //TIpo de Operación por DIAN
                $ProfileExecutionID = "2"; //1 si es produccion 2 si es pruebas
                $ID = $Prefix . $From;
                $IssueDate = $fechaActal = date('Y-m-d');
                $IssueTime = $fechaActal = date('H:i:s') . "-05:00";
                $InvoiceTypeCode = "01"; //Tipo de factura
                $LineCountNumeric = "1";
                $InvoiceStartDate = $inicioMes->format('Y-m-d');
                $InvoiceEndDate = $finMes->format('Y-m-d');

                //Información de la empresa
                $AdditionalAccountID = "1"; //1 si es natural 2 si es juridico
                $IndustryClasificationCode = "5440"; //codigo de la empresa
                $CompanyName = $res[0]['nombre_local'];
                $CompanyPostalCode = "252431"; //codigo postal ciudad
                $CompanyCity = "Girardot"; //nombre ciudad
                $CompanyDepto = "Cundinamarca"; //nombre departamento
                $CompanyDeptoCode = "97"; //codigo departamento
                $CompanyAddres = $res[0]['direccion'];
                $TaxLevelCode = "0-23"; //codigo significativo fiscal contribuyente, si son varios se pueden separar por ;
                $cityCode = "25307"; //codigo de la ciudad
                $TaxSchemeId = "01";
                $TaxSchemeName = "IVA";
                $MatriculaMercantil = "";
                //Información del cliente
                $AdditionalAccountID = "1"; //si la persona es natural es 1 si es juridio es 2
                $CustomerName = $resCliente[0]['primer_nombre']; //nombre cliente
                $CustomerCityCode = "25307"; //codigo postal ciudad clietne
                $CustomerCity = "Girardot"; //ciudad cliente cliente
                $CustomerDepto = "Cundinamarca"; //departamentyo cliente
                $customerDeptoCode  = "97"; //departamento codigo cliente
                $CustomerAddress = $res[0]['direccion']; //direcccion cliente
                $customerNit = $resCliente[0]['numero_cc'];
                $CostomerIdCode = "13"; //Tipo de Identificación clciente Nota: realizar modificacion para agregar codigo documento
                $SoftwareSecurityCode = hash('sha384', $SoftwareID . $ping . $customerNit);

                ///////////Metodo de Pago

                $PaymentMeansID = "1"; // 1 si es contado 2 si es credito
                $PaymentMeansCode = "10"; //Agregar segun anexo tenico DIAN

                $TaxableAmount = $resFactura[0]['total_factura'] - (isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0);
                $TaxAmount = $resFactura[0]['total_factura'];
                $Percent = 0;
                ///
                $LineExtensionAmount = $resFactura[0]['total_factura'] - (isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0);
                $AllowanceTotalAmount = "0";
                $TaxExclusiveAmount = "0";
                $TaxInclusiveAmount = $resFactura[0]['total_factura'];
                $PayableAmount = $resFactura[0]['total_factura'];


                ///
                $codImpt1 = "01";
                $valorImpt1 = $TaxAmount;
                $codImpt2 = "04";
                $valorImpt2 = 0.00;
                $codImpt3 = "03";
                $valorImpt3 = 0.00;
                number_format($LineExtensionAmount, 2);
                $cufe = $ID . $IssueDate . $IssueTime . $LineExtensionAmount . $codImpt1 . $valorImpt1 . $codImpt2 . $valorImpt2 . $codImpt3 . $valorImpt3 . $PayableAmount . $companyNit . $customerNit . $claveTecnica . $ProfileExecutionID; //Concatenación cufe
                $UUID = hash('sha384', $cufe);
                ////
                $QRCode = "NroFactura=$ID
                                NitFacturador=$companyNit
                                NitAdquiriente=$customerNit
                                FechaFactura=$IssueDate
                                ValorTotalFactura=$PayableAmount
                                CUFE=$UUID
                                URL=https://catalogo-vpfe-hab.dian.gov.co/document/searchqr?documentkey=$UUID"; //Datos de la factura

                $firma = xmlfirma();

                $xml = formHeadXML() .
                    formExtensionsXML($InvoiceAuthorization, $StartDate, $EndDate, $Prefix, $From, $To, $companyNit, $SoftwareID, $SoftwareSecurityCode, $AuthorizationProviderID, $QRCode, $firma) .
                    formVersionXML($CustomizationID, $ProfileExecutionID, $ID, $UUID, $IssueDate, $IssueTime, $InvoiceTypeCode, $LineCountNumeric, $InvoiceStartDate, $InvoiceEndDate) .
                    formCompanyXML($AdditionalAccountID, $IndustryClasificationCode, $CompanyName, $CompanyPostalCode, $companyNit, $CompanyCity, $CompanyDepto, $CompanyDeptoCode, $CompanyAddres, $TaxLevelCode, $cityCode, $TaxSchemeId, $TaxSchemeName) .
                    formCustumerXML($AdditionalAccountID, $CustomerName, $CustomerCityCode, $CustomerCity, $CustomerDepto, $customerDeptoCode, $CustomerAddress, $CostomerIdCode, $customerNit) .
                    formTotalXML($PaymentMeansID, $PaymentMeansCode, $TaxableAmount, $Percent, $TaxAmount, $LineExtensionAmount, $AllowanceTotalAmount, $TaxExclusiveAmount, $TaxInclusiveAmount, $PayableAmount) .
                    formLineXML($resVenta);

                validarXML($xml);

                function getErrors()
                {
                    $errors = libxml_get_errors();
                    $formattedErrors = '';

                    foreach ($errors as $error) {
                        $formattedErrors .= displayLibxmlError($error);
                    }

                    libxml_clear_errors();

                    return $formattedErrors;
                }

                function displayLibxmlError($error)
                {
                    $return = "";

                    switch ($error->level) {
                        case LIBXML_ERR_WARNING:
                            $return .= "Warning $error->code: ";
                            break;
                        case LIBXML_ERR_ERROR:
                            $return .= "Error $error->code: ";
                            break;
                        case LIBXML_ERR_FATAL:
                            $return .= "Fatal Error $error->code: ";
                            break;
                    }

                    $return .= trim($error->message);

                    if ($error->file) {
                        $return .= " in $error->file";
                    }

                    $return .= " on line $error->line\n";

                    return $return;
                }

                print "
        <script>
                // Incluir las funciones JavaScript aquí
        
                function generateXMLContent() {
                    const xmlData = `$xml`;
                    return xmlData;
                }
        
                
                    const xmlContent = generateXMLContent();
                    
                    // Crear un blob con el contenido XML
                    const blob = new Blob([xmlContent], { type: 'application/xml' });
                    
                    // Crear una URL para el blob
                    const url = URL.createObjectURL(blob);
                    
                    // Crear un enlace temporal
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = 'xml.xml'; // Nombre del archivo a descargar
                    
                    // Simular un clic en el enlace para iniciar la descarga
                    document.body.appendChild(link);
                    link.click();
                    
                    // Limpiar
                    document.body.removeChild(link);
                    URL.revokeObjectURL(url);
                
            </script>
        ";

                ob_start();

                require_once('vendor/tecnickcom/tcpdf/tcpdf.php');

                // Datos de la factura y QR
                $UUID = '1234-5678-9012-3456';
                $qrURL = "https://catalogo-vpfe-hab.dian.gov.co/document/searchqr?documentkey=$UUID";

                // Crear el PDF
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                // Configuración básica del documento
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Tu Empresa');
                $pdf->SetTitle('Factura Electrónica');
                $pdf->SetSubject('Factura Electrónica con QR');
                $pdf->SetKeywords('Factura, PDF, QR, Electrónica');

                // Configurar encabezado
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);
                $pdf->SetMargins(10, 10, 10);

                // Añadir una página
                $pdf->AddPage();

                // Añadir el logo de la empresa (ajusta la ruta y dimensiones del logo según sea necesario)
                $logoPath = 'http://localhost/juniorPizza/views/img/icon.jpg'; // Ruta de la imagen del logo
                $pdf->Image($logoPath, 10, 10, 50, 40, 'JPG'); // Posición (X, Y) y dimensiones (ancho, alto)

                // Añadir información del cliente
                $pdf->SetFont('helvetica', '', 12);
                $pdf->Text(10, 60, 'Cliente: ' . htmlspecialchars($resCliente[0]['primer_nombre'] . " " . $resCliente[0]['primer_apellido'] ?? 'Nombre del Cliente'));
                $pdf->Text(10, 65, 'Cédula: ' . htmlspecialchars($resCliente[0]['numero_cc'] ?? 'CC o NIT'));

                // Configuración del código QR con la URL
                $style = array(
                    'border' => 1,
                    'vpadding' => 'auto',
                    'hpadding' => 'auto',
                    'fgcolor' => array(0, 0, 0),
                    'bgcolor' => false,
                    'module_width' => 1, // Ancho del módulo
                    'module_height' => 1, // Altura del módulo
                );

                // Generar el QR
                $pdf->write2DBarcode($qrURL, 'QRCODE,H', 140, 30, 50, 50, $style, 'N');
                $pdf->Text(135, 85, 'Escanee el código para verificar');

                // Contenido de la factura en HTML
                $html = '
<h1>Factura Electrónica</h1>
<p>Factura N°: ' . htmlspecialchars($resFactura[0]['id_factura']) . '</p>
<p>Fecha: ' . htmlspecialchars($IssueDate) . '</p>
<p>Sistema: ' . htmlspecialchars($res[0]['nombre_local'] ?? 'Inventario') . '</p>
<p>Nit: ' . htmlspecialchars($res[0]['nit'] ?? '1111') . '</p>
<p>Teléfono: ' . htmlspecialchars($res[0]['telefono'] ?? '11111') . '</p>
<p>Dirección: ' . htmlspecialchars($res[0]['direccion'] ?? 'NNNNN') . '</p>
<br>
<table border="1" cellpadding="4" cellspacing="0">
    <thead>
        <tr>
            <th><strong>Código</strong></th>
            <th><strong>Producto</strong></th>
            <th><strong>Precio</strong></th>
            <th><strong>Cantidad</strong></th>
            <th><strong>Total</strong></th>
        </tr>
    </thead>
    <tbody>';

                foreach ($resVenta as $item) {
                    $html .= '<tr>
        <td>' . htmlspecialchars($item['codigo_producto']) . '</td>
        <td>' . htmlspecialchars($item['nombre_producto']) . '</td>
        <td>' . htmlspecialchars(number_format($item['valor_unitario'], 0)) . '</td>
        <td>' . htmlspecialchars($item['cantidad'] > 0 ? $item['cantidad'] : $item['peso'] . ' GR') . '</td>
        <td>' . htmlspecialchars(number_format($item['precio_compra'], 0)) . '</td>
    </tr>';
                }

                $html .= '</tbody></table>
<br><br>';

                if (isset($_SESSION['propina']) && $_SESSION['propina'] == 'true') {
                    $html .= '<p><strong>SubTotal:</strong> ' . htmlspecialchars(number_format($resFactura[0]['total_factura'] - (isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0), 0)) . '</p>';
                    $html .= '<p><strong>Propinas:</strong> ' . htmlspecialchars(number_format(isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0, 0)) . '</p>';
                }

                $html .= '<p><strong>Total:</strong> ' . htmlspecialchars(number_format($resFactura[0]['total_factura'], 0)) . '</p>';
                $html .= '<p><strong>Paga:</strong> ' . htmlspecialchars(number_format($resFactura[0]['efectivo'], 0)) . '</p>';
                $html .= '<p><strong>Cambio:</strong> ' . htmlspecialchars(number_format($resFactura[0]['cambio'], 0)) . '</p>';

                // Escribir el contenido HTML en el PDF
                $pdf->writeHTML($html, true, false, true, false, '');

                // Guardar el PDF en archivo
                $pdfFilePath = __DIR__ . '/factura_electronica.pdf'; // Usa una ruta absoluta
                $pdf->Output($pdfFilePath, 'F');  // Guardar en archivo

                ob_end_flush(); // Limpiar el buffer de salida


                // Envío de correo electrónico
                $xmlContent = $xml;
                $xmlFilePath = 'factura.xml';
                file_put_contents($xmlFilePath, $xmlContent);
                $mail = new PHPMailer(true);

                try {
                    // Configuración del servidor
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Cambia esto por tu servidor SMTP
                    $mail->SMTPAuth = true;
                    $mail->Username = 'feliperenjifoz@gmail.com'; // Tu correo electrónico
                    $mail->Password = 'eojcvtovqfdueobs'; // Tu contraseña de correo
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587; // Puerto SMTP

                    // Remitente y destinatario
                    $mail->setFrom('tu_email@example.com', 'Tu Nombre');
                    $mail->addAddress($resCliente[0]['correo']);
                    $mail->addAddress('feliperenjifoz@gmail.com'); // Segundo destinatario

                    // Adjuntar archivos
                    $mail->addAttachment($xmlFilePath); // Adjuntar XML
                    $mail->addAttachment($pdfFilePath); // Adjuntar PDF

                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = 'Factura electronica N° ' . $resFactura[0]['id_factura'];
                    $mail->Body = 'Estimado cliente, adjunto encontrará su factura electrónica.';

                    // Enviar el correo
                    $mail->send();
                    echo '<script>swal("Hurra!!!", "El correo con su factura fue entregado correctamente", "success");</script>';
                } catch (Exception $e) {
                    echo '<script>swal("Ups!!", "No se logró enviar tu factura al correo proporcionado. Error: ' . $mail->ErrorInfo . '", "error");</script>';
                }
?>
                <a href="#" id="downloadPdf" style="display:none;">Descargar PDF</a>
                <script>
                    window.addEventListener('load', function() {
                        // Usa una ruta accesible a través de HTTP
                        const pdfUrl = '/juniorPizza/views/moduls/factura_electronica.pdf'; // Ruta accesible vía HTTP

                        // Obtener el enlace con id "downloadPdf"
                        const a = document.getElementById('downloadPdf');

                        if (a) {
                            // Establecer el atributo href con la ruta del archivo PDF
                            a.href = pdfUrl;
                            a.download = 'factura_electronica.pdf';

                            // Simular clic para descargar el archivo
                            a.click();
                        } else {
                            console.error('No se encontró el elemento con id "downloadPdf".');
                        }
                    });
                </script>
            <?php
            }
        } else {
            if ($resFactura[0]['factura'] == "true") {
                $añoActual = date('Y');
                $mesActual = date('m');

                // Crear un objeto DateTime para el primer día del mes actual
                $inicioMes = new DateTime("$añoActual-$mesActual-01");

                // Clonar el objeto para obtener la fecha de fin y modificarlo al último día del mes
                $finMes = clone $inicioMes;
                $finMes->modify('last day of this month');
                ///////////////////////////////////////////////////
                date_default_timezone_set('America/Mexico_City');
                $claveTecnica = "fc8eac422eba16e22ffd8c6f94b3f40a6e38162c"; //esta clave es generada por la DIAn
                $InvoiceAuthorization = "18760000001"; //numeor de autorizacion por la dian
                $StartDate = "2019-01-19"; //fecha inico de factura por DIAN
                $EndDate = "2030-01-19"; // Fecha fin de factura por DIAN
                $Prefix = "SETG"; //Prefijo dado por DINA
                $From = "980000000"; // Inicio de facturas por DIAN
                $To = "985000000"; // Fin de facturas por Dian
                $companyNit = "11206481"; // Nit dado por DIAN
                $SoftwareID = "fa326ca7-c1f8-40d3-a6fc-24d7c1040607"; //ID software dado por DIAN
                $ping = "20191"; //Ping dado por DIan
                $AuthorizationProviderID = "800197268"; //Autorización Provider dado por DIAN


                $CustomizationID = "10"; //TIpo de Operación por DIAN
                $ProfileExecutionID = "2"; //1 si es produccion 2 si es pruebas
                $ID = $Prefix . $From;
                $IssueDate = $fechaActal = date('Y-m-d');
                $IssueTime = $fechaActal = date('H:i:s') . "-05:00";
                $InvoiceTypeCode = "01"; //Tipo de factura
                $LineCountNumeric = "1";
                $InvoiceStartDate = $inicioMes->format('Y-m-d');
                $InvoiceEndDate = $finMes->format('Y-m-d');

                //Información de la empresa
                $AdditionalAccountID = "1"; //1 si es natural 2 si es juridico
                $IndustryClasificationCode = "5440"; //codigo de la empresa
                $CompanyName = $res[0]['nombre_local'];
                $CompanyPostalCode = "252431"; //codigo postal ciudad
                $CompanyCity = "Girardot"; //nombre ciudad
                $CompanyDepto = "Cundinamarca"; //nombre departamento
                $CompanyDeptoCode = "97"; //codigo departamento
                $CompanyAddres = $res[0]['direccion'];
                $TaxLevelCode = "0-23"; //codigo significativo fiscal contribuyente, si son varios se pueden separar por ;
                $cityCode = "25307"; //codigo de la ciudad
                $TaxSchemeId = "01";
                $TaxSchemeName = "IVA";
                $MatriculaMercantil = "";
                //Información del cliente
                $AdditionalAccountID = "1"; //si la persona es natural es 1 si es juridio es 2
                $CustomerName = $resCliente[0]['primer_nombre']; //nombre cliente
                $CustomerCityCode = "25307"; //codigo postal ciudad clietne
                $CustomerCity = "Girardot"; //ciudad cliente cliente
                $CustomerDepto = "Cundinamarca"; //departamentyo cliente
                $customerDeptoCode  = "97"; //departamento codigo cliente
                $CustomerAddress = $res[0]['direccion']; //direcccion cliente
                $customerNit = $resCliente[0]['numero_cc'];
                $CostomerIdCode = "13"; //Tipo de Identificación clciente Nota: realizar modificacion para agregar codigo documento
                $SoftwareSecurityCode = hash('sha384', $SoftwareID . $ping . $customerNit);

                ///////////Metodo de Pago

                $PaymentMeansID = "1"; // 1 si es contado 2 si es credito
                $PaymentMeansCode = "10"; //Agregar segun anexo tenico DIAN

                $TaxableAmount = $resFactura[0]['total_factura'] - (isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0);
                $TaxAmount = $resFactura[0]['total_factura'];
                $Percent = 0;
                ///
                $LineExtensionAmount = $resFactura[0]['total_factura'] - (isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0);
                $AllowanceTotalAmount = "0";
                $TaxExclusiveAmount = "0";
                $TaxInclusiveAmount = $resFactura[0]['total_factura'];
                $PayableAmount = $resFactura[0]['total_factura'];


                ///
                $codImpt1 = "01";
                $valorImpt1 = $TaxAmount;
                $codImpt2 = "04";
                $valorImpt2 = 0.00;
                $codImpt3 = "03";
                $valorImpt3 = 0.00;
                number_format($LineExtensionAmount, 2);
                $cufe = $ID . $IssueDate . $IssueTime . $LineExtensionAmount . $codImpt1 . $valorImpt1 . $codImpt2 . $valorImpt2 . $codImpt3 . $valorImpt3 . $PayableAmount . $companyNit . $customerNit . $claveTecnica . $ProfileExecutionID; //Concatenación cufe
                $UUID = hash('sha384', $cufe);
                ////
                $QRCode = "NroFactura=$ID
                                NitFacturador=$companyNit
                                NitAdquiriente=$customerNit
                                FechaFactura=$IssueDate
                                ValorTotalFactura=$PayableAmount
                                CUFE=$UUID
                                URL=https://catalogo-vpfe-hab.dian.gov.co/document/searchqr?documentkey=$UUID"; //Datos de la factura

                $firma = xmlfirma();

                $xml = formHeadXML() .
                    formExtensionsXML($InvoiceAuthorization, $StartDate, $EndDate, $Prefix, $From, $To, $companyNit, $SoftwareID, $SoftwareSecurityCode, $AuthorizationProviderID, $QRCode, $firma) .
                    formVersionXML($CustomizationID, $ProfileExecutionID, $ID, $UUID, $IssueDate, $IssueTime, $InvoiceTypeCode, $LineCountNumeric, $InvoiceStartDate, $InvoiceEndDate) .
                    formCompanyXML($AdditionalAccountID, $IndustryClasificationCode, $CompanyName, $CompanyPostalCode, $companyNit, $CompanyCity, $CompanyDepto, $CompanyDeptoCode, $CompanyAddres, $TaxLevelCode, $cityCode, $TaxSchemeId, $TaxSchemeName) .
                    formCustumerXML($AdditionalAccountID, $CustomerName, $CustomerCityCode, $CustomerCity, $CustomerDepto, $customerDeptoCode, $CustomerAddress, $CostomerIdCode, $customerNit) .
                    formTotalXML($PaymentMeansID, $PaymentMeansCode, $TaxableAmount, $Percent, $TaxAmount, $LineExtensionAmount, $AllowanceTotalAmount, $TaxExclusiveAmount, $TaxInclusiveAmount, $PayableAmount) .
                    formLineXML($resVenta);

                validarXML($xml);

                function getErrors()
                {
                    $errors = libxml_get_errors();
                    $formattedErrors = '';

                    foreach ($errors as $error) {
                        $formattedErrors .= displayLibxmlError($error);
                    }

                    libxml_clear_errors();

                    return $formattedErrors;
                }

                function displayLibxmlError($error)
                {
                    $return = "";

                    switch ($error->level) {
                        case LIBXML_ERR_WARNING:
                            $return .= "Warning $error->code: ";
                            break;
                        case LIBXML_ERR_ERROR:
                            $return .= "Error $error->code: ";
                            break;
                        case LIBXML_ERR_FATAL:
                            $return .= "Fatal Error $error->code: ";
                            break;
                    }

                    $return .= trim($error->message);

                    if ($error->file) {
                        $return .= " in $error->file";
                    }

                    $return .= " on line $error->line\n";

                    return $return;
                }

                print "
        <script>
                // Incluir las funciones JavaScript aquí
        
                function generateXMLContent() {
                    const xmlData = `$xml`;
                    return xmlData;
                }
        
                
                    const xmlContent = generateXMLContent();
                    
                    // Crear un blob con el contenido XML
                    const blob = new Blob([xmlContent], { type: 'application/xml' });
                    
                    // Crear una URL para el blob
                    const url = URL.createObjectURL(blob);
                    
                    // Crear un enlace temporal
                    const link = document.createElement('a');
                    link.href = url;
                    link.download = 'xml.xml'; // Nombre del archivo a descargar
                    
                    // Simular un clic en el enlace para iniciar la descarga
                    document.body.appendChild(link);
                    link.click();
                    
                    // Limpiar
                    document.body.removeChild(link);
                    URL.revokeObjectURL(url);
                
            </script>
        ";

                ob_start();

                require_once('vendor/tecnickcom/tcpdf/tcpdf.php');

                // Datos de la factura y QR
                $UUID = '1234-5678-9012-3456';
                $qrURL = "https://catalogo-vpfe-hab.dian.gov.co/document/searchqr?documentkey=$UUID";

                // Crear el PDF
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

                // Configuración básica del documento
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Tu Empresa');
                $pdf->SetTitle('Factura Electrónica');
                $pdf->SetSubject('Factura Electrónica con QR');
                $pdf->SetKeywords('Factura, PDF, QR, Electrónica');

                // Configurar encabezado
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);
                $pdf->SetMargins(10, 10, 10);

                // Añadir una página
                $pdf->AddPage();

                // Añadir el logo de la empresa (ajusta la ruta y dimensiones del logo según sea necesario)
                $logoPath = 'http://localhost/juniorPizza/views/img/icon.jpg'; // Ruta de la imagen del logo
                $pdf->Image($logoPath, 10, 10, 50, 40, 'JPG'); // Posición (X, Y) y dimensiones (ancho, alto)

                // Añadir información del cliente
                $pdf->SetFont('helvetica', '', 12);
                $pdf->Text(10, 60, 'Cliente: ' . htmlspecialchars($resCliente[0]['primer_nombre'] . " " . $resCliente[0]['primer_apellido'] ?? 'Nombre del Cliente'));
                $pdf->Text(10, 65, 'Cédula: ' . htmlspecialchars($resCliente[0]['numero_cc'] ?? 'CC o NIT'));

                // Configuración del código QR con la URL
                $style = array(
                    'border' => 1,
                    'vpadding' => 'auto',
                    'hpadding' => 'auto',
                    'fgcolor' => array(0, 0, 0),
                    'bgcolor' => false,
                    'module_width' => 1, // Ancho del módulo
                    'module_height' => 1, // Altura del módulo
                );

                // Generar el QR
                $pdf->write2DBarcode($qrURL, 'QRCODE,H', 140, 30, 50, 50, $style, 'N');
                $pdf->Text(135, 85, 'Escanee el código para verificar');

                // Contenido de la factura en HTML
                $html = '
<h1>Factura Electrónica</h1>
<p>Factura N°: ' . htmlspecialchars($resFactura[0]['id_factura']) . '</p>
<p>Fecha: ' . htmlspecialchars($IssueDate) . '</p>
<p>Sistema: ' . htmlspecialchars($res[0]['nombre_local'] ?? 'Inventario') . '</p>
<p>Nit: ' . htmlspecialchars($res[0]['nit'] ?? '1111') . '</p>
<p>Teléfono: ' . htmlspecialchars($res[0]['telefono'] ?? '11111') . '</p>
<p>Dirección: ' . htmlspecialchars($res[0]['direccion'] ?? 'NNNNN') . '</p>
<br>
<table border="1" cellpadding="4" cellspacing="0">
    <thead>
        <tr>
            <th><strong>Código</strong></th>
            <th><strong>Producto</strong></th>
            <th><strong>Precio</strong></th>
            <th><strong>Cantidad</strong></th>
            <th><strong>Total</strong></th>
        </tr>
    </thead>
    <tbody>';

                foreach ($resVenta as $item) {
                    $html .= '<tr>
        <td>' . htmlspecialchars($item['codigo_producto']) . '</td>
        <td>' . htmlspecialchars($item['nombre_producto']) . '</td>
        <td>' . htmlspecialchars(number_format($item['valor_unitario'], 0)) . '</td>
        <td>' . htmlspecialchars($item['cantidad'] > 0 ? $item['cantidad'] : $item['peso'] . ' GR') . '</td>
        <td>' . htmlspecialchars(number_format($item['precio_compra'], 0)) . '</td>
    </tr>';
                }

                $html .= '</tbody></table>
<br><br>';

                if (isset($_SESSION['propina']) && $_SESSION['propina'] == 'true') {
                    $html .= '<p><strong>SubTotal:</strong> ' . htmlspecialchars(number_format($resFactura[0]['total_factura'] - (isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0), 0)) . '</p>';
                    $html .= '<p><strong>Propinas:</strong> ' . htmlspecialchars(number_format(isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0, 0)) . '</p>';
                }

                $html .= '<p><strong>Total:</strong> ' . htmlspecialchars(number_format($resFactura[0]['total_factura'], 0)) . '</p>';
                $html .= '<p><strong>Paga:</strong> ' . htmlspecialchars(number_format($resFactura[0]['efectivo'], 0)) . '</p>';
                $html .= '<p><strong>Cambio:</strong> ' . htmlspecialchars(number_format($resFactura[0]['cambio'], 0)) . '</p>';

                // Escribir el contenido HTML en el PDF
                $pdf->writeHTML($html, true, false, true, false, '');

                // Guardar el PDF en archivo
                $pdfFilePath = __DIR__ . '/factura_electronica.pdf'; // Usa una ruta absoluta
                $pdf->Output($pdfFilePath, 'F');  // Guardar en archivo

                ob_end_flush(); // Limpiar el buffer de salida


                // Envío de correo electrónico
                $xmlContent = $xml;
                $xmlFilePath = 'factura.xml';
                file_put_contents($xmlFilePath, $xmlContent);
                $mail = new PHPMailer(true);

                try {
                    // Configuración del servidor
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Cambia esto por tu servidor SMTP
                    $mail->SMTPAuth = true;
                    $mail->Username = 'feliperenjifoz@gmail.com'; // Tu correo electrónico
                    $mail->Password = 'eojcvtovqfdueobs'; // Tu contraseña de correo
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587; // Puerto SMTP

                    // Remitente y destinatario
                    $mail->setFrom('tu_email@example.com', 'Tu Nombre');
                    $mail->addAddress($resCliente[0]['correo']);
                    $mail->addAddress('feliperenjifoz@gmail.com'); // Segundo destinatario

                    // Adjuntar archivos
                    $mail->addAttachment($xmlFilePath); // Adjuntar XML
                    $mail->addAttachment($pdfFilePath); // Adjuntar PDF

                    // Contenido del correo
                    $mail->isHTML(true);
                    $mail->Subject = 'Factura electronica N° ' . $resFactura[0]['id_factura'];
                    $mail->Body = 'Estimado cliente, adjunto encontrará su factura electrónica.';

                    // Enviar el correo
                    $mail->send();
                    echo '<script>swal("Hurra!!!", "El correo con su factura fue entregado correctamente", "success");</script>';
                } catch (Exception $e) {
                    echo '<script>swal("Ups!!", "No se logró enviar tu factura al correo proporcionado. Error: ' . $mail->ErrorInfo . '", "error");</script>';
                }
            ?>
                <a href="#" id="downloadPdf" style="display:none;">Descargar PDF</a>
                <script>
                    window.addEventListener('load', function() {
                        // Usa una ruta accesible a través de HTTP
                        const pdfUrl = '/juniorPizza/views/moduls/factura_electronica.pdf'; // Ruta accesible vía HTTP

                        // Obtener el enlace con id "downloadPdf"
                        const a = document.getElementById('downloadPdf');

                        if (a) {
                            // Establecer el atributo href con la ruta del archivo PDF
                            a.href = pdfUrl;
                            a.download = 'factura_electronica.pdf';

                            // Simular clic para descargar el archivo
                            a.click();
                        } else {
                            console.error('No se encontró el elemento con id "downloadPdf".');
                        }
                    });
                </script>
<?php
            }
        }
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <div style="text-align: right;">
                <p>FACTURA N°<span id="num_factura"><?php echo $resFactura[0]['id_factura'] ?></span></p>
            </div>
            <div style="text-align: right;">
                Fecha:
                <?php
                print $fecha;
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
                </span><br>
                <?php
                if (isset($_SESSION['factura'])) {
                    if ($_SESSION['factura'] == 'true') {
                        if ($resFactura[0]['factura'] == "true") {
                ?>
                            <span>DOCUMENTO EQUIVALENTE ELECTRONICO TIQUETE DE MAQUINA REGISTRADORA A CON SISTEMA P.O.S</span><br>
                            <span>Adquiriente: <?php echo $resCliente[0]['primer_nombre'] . " " . $resCliente[0]['primer_apellido'] ?></span><br>
                            <span>Identificación: <?php echo $resCliente[0]['numero_cc'] ?></span>
                <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="table-responsive">
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
                            <?php echo number_format($value['valor_unitario'], 0) ?>
                        </td>
                        <td>
                            <?php if ($value['cantidad'] > 0) {
                                echo $value['cantidad'];
                            } else {
                                echo $value['peso'] . " GR";
                            } ?>
                        </td>
                        <td>
                            <?php echo number_format($value['precio_compra'], 0) ?>
                        </td>
                    </tr>
                <?php
                }

                ?>
            </tbody>
            <?php if (isset($_SESSION['propina'])) {
                if ($_SESSION['propina'] == 'true') {
            ?>
                    <tbody>
                        <tr>
                            <th>SubTotal</th>
                            <th></th>
                            <!--<th></th>-->
                            <!--<th></th>-->
                            <th></th>
                            <th></th>
                            <th><?php echo number_format($resFactura[0]['total_factura'] - (isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0), 0) ?></th>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <th>Propinas</th>
                            <th></th>
                            <!--<th></th>-->
                            <!--<th></th>-->
                            <th></th>
                            <th></th>
                            <th <?php if (isset($_GET['id_factura'])) {
                                    echo 'class="miTabla"';
                                } ?>><?php echo number_format(isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0, 0) ?></th>
                        </tr>
                    </tbody>
            <?php }
            } ?>
            <tbody>
                <tr>
                    <th>Total</th>
                    <th></th>
                    <!--<th></th>-->
                    <!--<th></th>-->
                    <th></th>
                    <th></th>
                    <th><?php echo number_format($resFactura[0]['total_factura'], 0) ?></th>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <th>Paga</th>
                    <th>
                        <?php echo number_format($resFactura[0]['efectivo'], 0) ?>
                    </th>
                    <th></th>
                    <th>Cambio</th>
                    <th>
                        <?php echo number_format($resFactura[0]['cambio'], 0) ?>
                    </th>
                </tr>
            </tbody>
        </table>
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
                    <input hidden id="separador" value=" " class="input" type="text" maxlength="1" placeholder="El separador de columnas">
                </div>
            </div>
            <div class="field">
                <!--<label class="label">Relleno</label>-->
                <div class="control">
                    <input hidden id="relleno" value=" " class="input" type="text" maxlength="1" placeholder="El relleno de las celdas">
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
                <input type="hidden" id="cufe" value="<?php echo $UUID = hash('sha384', $cufe); ?>">
            </div>
            <button id="Imprimir" class="btn btn-primary mt-2">Imprimir</button>
            <a id="caja" href="caja" class="btn btn-primary mt-2">Caja</a>
            <?php
            if (isset($_GET['factura'])) {
            ?>
                <form action="" method="post">
                    <button class="btn btn-primary mt-2" name="enviar_correo">Enviar Factura</button>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php

function validarXML($doc)
{

    libxml_use_internal_errors(true);

    $xml = new DOMDocument();
    $xml->loadXML($doc);
    $doc_validator = "C:/xampp/htdocs/juniorPizza/views/xmlValidator/UBL-Invoice-2.1.xsd";

    if ($xml->schemaValidate($doc_validator)) {
        //echo "enviado";
    } else {
        echo getErrors();
        //echo "fallo";
    }
}

function formHeadXML()
{
    $xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?><Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:sts="dian:gov:co:facturaelectronica:Structures-2-1" xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2 http://docs.oasis-open.org/ubl/os-UBL-2.1/xsd/maindoc/UBL-Invoice-2.1.xsd">';
    return $xml;
}

function formExtensionsXML($InvoiceAuthorization, $StartDate, $EndDate, $Prefix, $From, $To, $companyNit, $SoftwareID, $SoftwareSecurityCode, $AuthorizationProviderID, $QRCode, $firma)
{
    $xml = "
            <ext:UBLExtensions>
              <ext:UBLExtension>
                 <ext:ExtensionContent>
                    <sts:DianExtensions>
                       <sts:InvoiceControl>
                          <sts:InvoiceAuthorization>$InvoiceAuthorization</sts:InvoiceAuthorization>
                                <sts:AuthorizationPeriod>
                             <cbc:StartDate>$StartDate</cbc:StartDate>
                             <cbc:EndDate>$EndDate</cbc:EndDate>
                                </sts:AuthorizationPeriod>
                          <sts:AuthorizedInvoices>
                                    <sts:Prefix>
                                        $Prefix
                                    </sts:Prefix>
                             <sts:From>
                                        $From
                                    </sts:From>
                             <sts:To>
                                        $To
                                    </sts:To>
                          </sts:AuthorizedInvoices>
                       </sts:InvoiceControl>
                       <sts:InvoiceSource>
                                 <cbc:IdentificationCode listAgencyID='6' listAgencyName='United Nations Economic Commission for Europe' listSchemeURI='urn:oasis:names:specification:ubl:codelist:gc:CountryIdentificationCode-2.1'>CO</cbc:IdentificationCode>
                       </sts:InvoiceSource>
                            <sts:SoftwareProvider>
                                <sts:ProviderID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='4' schemeName='31'>
                                    $companyNit
                                </sts:ProviderID>
                          <sts:SoftwareID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)'>
                                    $SoftwareID
                                </sts:SoftwareID>
                       </sts:SoftwareProvider>
                            <sts:SoftwareSecurityCode schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)'>
                                $SoftwareSecurityCode
                            </sts:SoftwareSecurityCode>
                            <sts:AuthorizationProvider>
                                <sts:AuthorizationProviderID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='4' schemeName='31'>
                                    $AuthorizationProviderID
                                </sts:AuthorizationProviderID>
                            </sts:AuthorizationProvider>
                            <sts:QRCode>
                                $QRCode
                            </sts:QRCode>
                        </sts:DianExtensions>
                    </ext:ExtensionContent>
                </ext:UBLExtension>
                <ext:UBLExtension>
                    <ext:ExtensionContent>
                    $firma
                    </ext:ExtensionContent>
                </ext:UBLExtension>
            </ext:UBLExtensions>
            ";
    return $xml;
}

function formVersionXML($CustomizationID, $ProfileExecutionID, $ID, $UUID, $IssueDate, $IssueTime, $InvoiceTypeCode, $LineCountNumeric, $InvoiceStartDate, $InvoiceEndDate)
{
    $xml = "<cbc:UBLVersionID>
                UBL 2.1
            </cbc:UBLVersionID>
            <cbc:CustomizationID>$CustomizationID</cbc:CustomizationID>
            <cbc:ProfileID>DIAN 2.1</cbc:ProfileID>
            <cbc:ProfileExecutionID>$ProfileExecutionID</cbc:ProfileExecutionID>
            <cbc:ID>$ID</cbc:ID>
            <cbc:UUID schemeID='2' schemeName='CUFE-SHA384'>$UUID</cbc:UUID>
            <cbc:IssueDate>$IssueDate</cbc:IssueDate>
            <cbc:IssueTime>$IssueTime</cbc:IssueTime>
            <cbc:InvoiceTypeCode>$InvoiceTypeCode</cbc:InvoiceTypeCode>
            <cbc:DocumentCurrencyCode listAgencyID='6' listAgencyName='United Nations Economic Commission for Europe' listID='ISO 4217 Alpha'>COP</cbc:DocumentCurrencyCode>
            <cbc:LineCountNumeric>$LineCountNumeric</cbc:LineCountNumeric>
            <cac:InvoicePeriod>
                <cbc:StartDate>$InvoiceStartDate</cbc:StartDate>
                <cbc:EndDate>$InvoiceEndDate</cbc:EndDate>
            </cac:InvoicePeriod>
            ";
    return $xml;
}

function formCompanyXML($AdditionalAccountID, $IndustryClasificationCode, $CompanyName, $CompanyPostalCode, $companyNit, $CompanyCity, $CompanyDepto, $CompanyDeptoCode, $CompanyAddres, $TaxLevelCode, $cityCode, $TaxSchemeId, $TaxSchemeName)
{
    $xml = "<cac:AccountingSupplierParty>
                <cbc:AdditionalAccountID>$AdditionalAccountID</cbc:AdditionalAccountID>
                <cac:Party>
                    <cac:PartyName>
                        <cbc:Name>$CompanyName</cbc:Name>
                    </cac:PartyName>
                    <cac:PhysicalLocation>
                        <cac:Address>
                            <cbc:ID>$CompanyPostalCode</cbc:ID>
                            <cbc:CityName>$CompanyCity</cbc:CityName>
                            <cbc:CountrySubentity>$CompanyDepto</cbc:CountrySubentity>
                            <cbc:CountrySubentityCode>$CompanyDeptoCode</cbc:CountrySubentityCode>
                            <cac:AddressLine>
                                <cbc:Line>$CompanyAddres</cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode>CO</cbc:IdentificationCode>
                                <cbc:Name languageID='es'>Colombia</cbc:Name>
                            </cac:Country>
                        </cac:Address>
                    </cac:PhysicalLocation>
                    <cac:PartyTaxScheme>
                        <cbc:RegistrationName>$CompanyName</cbc:RegistrationName>
                        <cbc:CompanyID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='4' schemeName='31'>$companyNit</cbc:CompanyID>
                        <cbc:TaxLevelCode listName='05'>$TaxLevelCode</cbc:TaxLevelCode>
                        <cac:RegistrationAddress>
                            <cbc:ID>$cityCode</cbc:ID>
                            <cbc:CityName>$CompanyCity</cbc:CityName>
                            <cbc:CountrySubentity>$CompanyDepto</cbc:CountrySubentity>
                            <cbc:CountrySubentityCode>$CompanyDeptoCode</cbc:CountrySubentityCode>
                            <cac:AddressLine>
                                <cbc:Line>$CompanyAddres</cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode>CO</cbc:IdentificationCode>
                                <cbc:Name languageID='es'>Colombia</cbc:Name>
                            </cac:Country>
                        </cac:RegistrationAddress>
                        <cac:TaxScheme>
                            <cbc:ID>$TaxSchemeId</cbc:ID>
                            <cbc:Name>$TaxSchemeName</cbc:Name>
                        </cac:TaxScheme>
                    </cac:PartyTaxScheme>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName>$companyNit</cbc:RegistrationName>
                        <cbc:CompanyID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='9' schemeName='31'>$companyNit</cbc:CompanyID>
                    </cac:PartyLegalEntity>
                </cac:Party>
            </cac:AccountingSupplierParty>";
    return $xml;
}

function formCustumerXML($AdditionalAccountID, $CustomerName, $CustomerCityCode, $CustomerCity, $CustomerDepto, $customerDeptoCode, $CustomerAddress, $CostomerIdCode, $customerNit)
{
    $xml = "
            <cac:AccountingCustomerParty>
                <cbc:AdditionalAccountID>$AdditionalAccountID</cbc:AdditionalAccountID>
                <cac:Party>
                    <cac:PartyName>
                        <cbc:Name>$CustomerName</cbc:Name>
                    </cac:PartyName>
                    <cac:PhysicalLocation>
                        <cac:Address>
                            <cbc:ID>$CustomerCityCode</cbc:ID>
                            <cbc:CityName>$CustomerCity</cbc:CityName>
                            <cbc:CountrySubentity>$CustomerDepto</cbc:CountrySubentity>
                            <cbc:CountrySubentityCode>$customerDeptoCode</cbc:CountrySubentityCode>
                            <cac:AddressLine>
                                <cbc:Line>$CustomerAddress</cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode>CO</cbc:IdentificationCode>
                                <cbc:Name languageID='es'>Colombia</cbc:Name>
                            </cac:Country>
                        </cac:Address>
                    </cac:PhysicalLocation>
                    <cac:PartyTaxScheme>
                        <cbc:RegistrationName>$CustomerName</cbc:RegistrationName>
                        <cbc:CompanyID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeName='$CostomerIdCode'>$customerNit</cbc:CompanyID>
                        <cac:TaxScheme>
                            <cbc:ID>ZY</cbc:ID>
                            <cbc:Name>No Causa</cbc:Name>
                        </cac:TaxScheme>
                    </cac:PartyTaxScheme>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName>$CustomerName</cbc:RegistrationName>
                        <cbc:CompanyID schemeAgencyID='195' schemeAgencyName='CO, DIAN (Dirección de Impuestos y Aduanas Nacionales)' schemeID='3' schemeName='$CostomerIdCode'>$customerNit</cbc:CompanyID>
                    </cac:PartyLegalEntity>
                </cac:Party>
            </cac:AccountingCustomerParty>";
    return $xml;
}

function formTotalXML($PaymentMeansID, $PaymentMeansCode, $TaxableAmount, $Percent, $TaxAmount, $LineExtensionAmount, $AllowanceTotalAmount, $TaxExclusiveAmount, $TaxInclusiveAmount, $PayableAmount)
{
    $xml = "
            <cac:PaymentMeans>
                <cbc:ID>$PaymentMeansID</cbc:ID>
                <cbc:PaymentMeansCode>$PaymentMeansCode</cbc:PaymentMeansCode>
            </cac:PaymentMeans>
            <cac:TaxTotal>
                <cbc:TaxAmount currencyID='COP'>$TaxAmount</cbc:TaxAmount>
                <cac:TaxSubtotal>
                    <cbc:TaxableAmount currencyID='COP'>$TaxableAmount</cbc:TaxableAmount>
                    <cbc:TaxAmount currencyID='COP'>$TaxAmount</cbc:TaxAmount>
                    <cac:TaxCategory>
                        <cbc:Percent>$Percent</cbc:Percent>
                        <cac:TaxScheme>
                            <cbc:ID>01</cbc:ID>
                            <cbc:Name>IVA</cbc:Name>
                        </cac:TaxScheme>
                    </cac:TaxCategory>
                </cac:TaxSubtotal>
            </cac:TaxTotal>
            <cac:LegalMonetaryTotal>
                <cbc:LineExtensionAmount currencyID='COP'>$LineExtensionAmount</cbc:LineExtensionAmount>
                <cbc:TaxExclusiveAmount currencyID='COP'>$TaxExclusiveAmount</cbc:TaxExclusiveAmount>
                <cbc:TaxInclusiveAmount currencyID='COP'>$TaxInclusiveAmount</cbc:TaxInclusiveAmount>
                <cbc:PayableAmount currencyID='COP'>$PayableAmount</cbc:PayableAmount>
            </cac:LegalMonetaryTotal>";
    return $xml;
}

function formLineXML($resVenta)
{
    $xml = "";
    foreach ($resVenta as $key => $value) {
        //Productosw
        $lineID = $key + 1; //Consecutivo de cuantos productos hay en la factura
        $lineQty = $value['cantidad']; //Cantidad de productos vendidos
        $AllowanceCharge = "1"; //descuento por producto
        //Descuentos
        $LineBaseAmount = "0"; //valor antes de descuento
        $AllowancePercentage = "0"; //Porcentaje de descuento
        $LineAllowanceAmount = "0"; //Descuento
        $LineTotal = $value['precio_compra']; // Total con descuento
        ///
        $LineTax = "0"; //Valor IVA
        $LineTaxPercentage = "0"; //IVA
        //
        $LineItemName = $value['nombre_producto']; //Nombre Producto
        $LineTotal = $value['precio_compra']; //Total producto

        $xml .= "
                <cac:InvoiceLine>
                <cbc:ID>$lineID</cbc:ID>
                <cbc:InvoicedQuantity unitCode='EA'>$lineQty</cbc:InvoicedQuantity>
                <cbc:LineExtensionAmount currencyID='COP'>$LineTotal</cbc:LineExtensionAmount>
                <cbc:FreeOfChargeIndicator>false</cbc:FreeOfChargeIndicator>
                <cac:TaxTotal>
                    <cbc:TaxAmount currencyID='COP'>$LineTax</cbc:TaxAmount>
                    <cac:TaxSubtotal>
                        <cbc:TaxableAmount currencyID='COP'>$LineTotal</cbc:TaxableAmount>
                        <cbc:TaxAmount currencyID='COP'>$LineTax</cbc:TaxAmount>
                        <cac:TaxCategory>
                            <cbc:Percent>$LineTaxPercentage</cbc:Percent>
                            <cac:TaxScheme>
                                <cbc:ID>01</cbc:ID>
                                <cbc:Name>IVA</cbc:Name>
                            </cac:TaxScheme>
                        </cac:TaxCategory>
                    </cac:TaxSubtotal>
                </cac:TaxTotal>
                <cac:Item>
                    <cbc:Description>$LineItemName</cbc:Description>
                </cac:Item>
                <cac:Price>
                    <cbc:PriceAmount currencyID='COP'>$LineTotal</cbc:PriceAmount>
                    <cbc:BaseQuantity unitCode='EA'>$lineQty</cbc:BaseQuantity>
                </cac:Price>
            </cac:InvoiceLine>
            ";
    }
    return $xml . "</Invoice>";
}
function xmlfirma()
{
    $xml = '<ds:Signature Id="xmldsig-d0322c4f-be87-495a-95d5-9244980495f4">
        <ds:SignedInfo>
        <ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        <ds:SignatureMethod Algorithm="http://www.w3.org/2001/04/xmldsig-more#rsa-sha256"/>
        <ds:Reference Id="xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-ref0" URI="">
        <ds:Transforms>
        <ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
        </ds:Transforms>
        <ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/>
        <ds:DigestValue>akcOQ5qEh4dkMwt0d5BoXRR8Bo4vdy9DBZtfF5O0SsA=</ds:DigestValue>
        </ds:Reference>
        <ds:Reference URI="#xmldsig-87d128b5-aa31-4f0b-8e45-3d9cfa0eec26-keyinfo">
        <ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/>
        <ds:DigestValue>troRYR2fcmJLV6gYibVM6XlArbddSCkjYkACZJP47/4=</ds:DigestValue>
        </ds:Reference>
        <ds:Reference Type="http://uri.etsi.org/01903#SignedProperties" URI="#xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-signedprops">
        <ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/>
        <ds:DigestValue>hpIsyD/08hVUc1exnfEyhGyKX5s3pUPbpMKmPhkPPqU=</ds:DigestValue>
        </ds:Reference>
        </ds:SignedInfo>
        <ds:SignatureValue Id="xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-sigvalue">
        q4HWeb47oLdDM4D3YiYDOSXE4YfSHkQKxUfSYiEiPuP2XWvD7ELZTC4ENFv6krgDAXczmi0W7OMi
        LIVvuFz0ohPUc4KNlUEzqSBHVi6sC34sCqoxuRzOmMEoCB9Tr4VICxU1Ue9XhgP7o6X4f8KFAQWW
        NaeTtA6WaO/yUtq91MKP59aAnFMfYl8lXpaS0kpUwuui3wdCZsGycsl1prEWiwzpaukEUOXyTo7o
        RBOuNsDIUhP24Fv1alRFnX6/9zEOpRTs4rEQKN3IQnibF757LE/nnkutElZHTXaSV637gpHjXoUN
        5JrUwTNOXvmFS98N6DczCQfeNuDIozYwtFVlMw==
        </ds:SignatureValue>
        <ds:KeyInfo Id="xmldsig-87d128b5-aa31-4f0b-8e45-3d9cfa0eec26-keyinfo">
        <ds:X509Data>
        <ds:X509Certificate>
        MIIIODCCBiCgAwIBAgIIbAsHYmJtoOIwDQYJKoZIhvcNAQELBQAwgbQxIzAhBgkqhkiG9w0BCQEW
        FGluZm9AYW5kZXNzY2QuY29tLmNvMSMwIQYDVQQDExpDQSBBTkRFUyBTQ0QgUy5BLiBDbGFzZSBJ
        STEwMC4GA1UECxMnRGl2aXNpb24gZGUgY2VydGlmaWNhY2lvbiBlbnRpZGFkIGZpbmFsMRMwEQYD
        VQQKEwpBbmRlcyBTQ0QuMRQwEgYDVQQHEwtCb2dvdGEgRC5DLjELMAkGA1UEBhMCQ08wHhcNMTcw
        OTE2MTM0ODE5WhcNMjAwOTE1MTM0ODE5WjCCARQxHTAbBgNVBAkTFENhbGxlIEZhbHNhIE5vIDEy
        IDM0MTgwNgYJKoZIhvcNAQkBFilwZXJzb25hX2p1cmlkaWNhX3BydWViYXMxQGFuZGVzc2NkLmNv
        bS5jbzEsMCoGA1UEAxMjVXN1YXJpbyBkZSBQcnVlYmFzIFBlcnNvbmEgSnVyaWRpY2ExETAPBgNV
        BAUTCDExMTExMTExMRkwFwYDVQQMExBQZXJzb25hIEp1cmlkaWNhMSgwJgYDVQQLEx9DZXJ0aWZp
        Y2FkbyBkZSBQZXJzb25hIEp1cmlkaWNhMQ8wDQYDVQQHEwZCb2dvdGExFTATBgNVBAgTDEN1bmRp
        bmFtYXJjYTELMAkGA1UEBhMCQ08wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQC0Dn8t
        oZ2CXun+63zwYecJ7vNmEmS+YouH985xDek7ImeE9lMBHXE1M5KDo7iT/tUrcFwKj717PeVL52Nt
        B6WU4+KBt+nrK+R+OSTpTno5EvpzfIoS9pLI74hHc017rY0wqjl0lw+8m7fyLfi/JO7AtX/dthS+
        MKHIcZ1STPlkcHqmbQO6nhhr/CGl+tKkCMrgfEFIm1kv3bdWqk3qHrnFJ6s2GoVNZVCTZW/mOzPC
        NnnUW12LDd/Kd+MjN6aWbP0D/IJbB42Npqv8+/oIwgCrbt0sS1bysUgdT4im9bBhb00MWVmNRBBe
        3pH5knzkBid0T7TZsPCyiMBstiLT3yfpAgMBAAGjggLpMIIC5TAMBgNVHRMBAf8EAjAAMB8GA1Ud
        IwQYMBaAFKhLtPQLp7Zb1KAohRCdBBMzxKf3MDcGCCsGAQUFBwEBBCswKTAnBggrBgEFBQcwAYYb
        aHR0cDovL29jc3AuYW5kZXNzY2QuY29tLmNvMIIB4wYDVR0gBIIB2jCCAdYwggHSBg0rBgEEAYH0
        SAECCQIFMIIBvzBBBggrBgEFBQcCARY1aHR0cDovL3d3dy5hbmRlc3NjZC5jb20uY28vZG9jcy9E
        UENfQW5kZXNTQ0RfVjIuNS5wZGYwggF4BggrBgEFBQcCAjCCAWoeggFmAEwAYQAgAHUAdABpAGwA
        aQB6AGEAYwBpAPMAbgAgAGQAZQAgAGUAcwB0AGUAIABjAGUAcgB0AGkAZgBpAGMAYQBkAG8AIABl
        AHMAdADhACAAcwB1AGoAZQB0AGEAIABhACAAbABhAHMAIABQAG8AbADtAHQAaQBjAGEAcwAgAGQA
        ZQAgAEMAZQByAHQAaQBmAGkAYwBhAGQAbwAgAGQAZQAgAFAAZQByAHMAbwBuAGEAIABKAHUAcgDt
        AGQAaQBjAGEAIAAoAFAAQwApACAAeQAgAEQAZQBjAGwAYQByAGEAYwBpAPMAbgAgAGQAZQAgAFAA
        cgDhAGMAdABpAGMAYQBzACAAZABlACAAQwBlAHIAdABpAGYAaQBjAGEAYwBpAPMAbgAgACgARABQ
        AEMAKQAgAGUAcwB0AGEAYgBsAGUAYwBpAGQAYQBzACAAcABvAHIAIABBAG4AZABlAHMAIABTAEMA
        RDAdBgNVHSUEFjAUBggrBgEFBQcDAgYIKwYBBQUHAwQwRgYDVR0fBD8wPTA7oDmgN4Y1aHR0cDov
        L3d3dy5hbmRlc3NjZC5jb20uY28vaW5jbHVkZXMvZ2V0Q2VydC5waHA/Y3JsPTEwHQYDVR0OBBYE
        FL9BXJHmFVE5c5Ai8B1bVBWqXsj7MA4GA1UdDwEB/wQEAwIE8DANBgkqhkiG9w0BAQsFAAOCAgEA
        b/pa7yerHOu1futRt8QTUVcxCAtK9Q00u7p4a5hp2fVzVrhVQIT7Ey0kcpMbZVPgU9X2mTHGfPdb
        R0hYJGEKAxiRKsmAwmtSQgWh5smEwFxG0TD1chmeq6y0GcY0lkNA1DpHRhSK368vZlO1p2a6S13Y
        1j3tLFLqf5TLHzRgl15cfauVinEHGKU/cMkjLwxNyG1KG/FhCeCCmawATXWLgQn4PGgvKcNrz+y0
        cwldDXLGKqriw9dce2Zerc7OCG4/XGjJ2PyZOJK9j1VYIG4pnmoirVmZbKwWaP4/TzLs6LKaJ4b6
        6xLxH3hUtoXCzYQ5ehYyrLVwCwTmKcm4alrEht3FVWiWXA/2tj4HZiFoG+I1OHKmgkNv7SwHS7z9
        tFEFRaD3W3aD7vwHEVsq2jTeYInE0+7r2/xYFZ9biLBrryl+q22zM5W/EJq6EJPQ6SM/eLqkpzqM
        EF5OdcJ5kIOxLbrIdOh0+grU2IrmHXr7cWNP6MScSL7KSxhjPJ20F6eqkO1Z/LAxqNslBIKkYS24
        VxPbXu0pBXQvu+zAwD4SvQntIG45y/67h884I/tzYOEJi7f6/NFAEuV+lokw/1MoVsEgFESASI9s
        N0DfUniabyrZ3nX+LG3UFL1VDtDPWrLTNKtb4wkKwGVwqtAdGFcE+/r/1WG0eQ64xCq0NLutCxg=
        </ds:X509Certificate>
        </ds:X509Data>
        </ds:KeyInfo>
        <ds:Object><xades:QualifyingProperties Target="#xmldsig-d0322c4f-be87-495a-95d5-9244980495f4"><xades:SignedProperties Id="xmldsig-d0322c4f-be87-495a-95d5-9244980495f4-signedprops"><xades:SignedSignatureProperties><xades:SigningTime>2019-06-21T19:09:35.993-05:00</xades:SigningTime><xades:SigningCertificate><xades:Cert><xades:CertDigest><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/><ds:DigestValue>nem6KXhqlV0A0FK5o+MwJZ3Y1aHgmL1hDs/RMJu7HYw=</ds:DigestValue></xades:CertDigest><xades:IssuerSerial><ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD.,OU=Division de certificacion entidad final,CN=CA ANDES SCD S.A. Clase II,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName><ds:X509SerialNumber>7785324499979575522</ds:X509SerialNumber></xades:IssuerSerial></xades:Cert><xades:Cert><xades:CertDigest><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/><ds:DigestValue>oEsyOEeUGTXr45Jr0jHJx3l/9CxcsxPMOTarEiXOclY=</ds:DigestValue></xades:CertDigest><xades:IssuerSerial><ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion,CN=ROOT CA ANDES SCD S.A.,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName><ds:X509SerialNumber>8136867327090815624</ds:X509SerialNumber></xades:IssuerSerial></xades:Cert><xades:Cert><xades:CertDigest><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/><ds:DigestValue>Cs7emRwtXWVYHJrqS9eXEXfUcFyJJBqFhDFOetHu8ts=</ds:DigestValue></xades:CertDigest><xades:IssuerSerial><ds:X509IssuerName>C=CO,L=Bogota D.C.,O=Andes SCD,OU=Division de certificacion,CN=ROOT CA ANDES SCD S.A.,1.2.840.113549.1.9.1=#1614696e666f40616e6465737363642e636f6d2e636f</ds:X509IssuerName><ds:X509SerialNumber>3184328748892787122</ds:X509SerialNumber></xades:IssuerSerial></xades:Cert></xades:SigningCertificate><xades:SignaturePolicyIdentifier><xades:SignaturePolicyId><xades:SigPolicyId><xades:Identifier>https://facturaelectronica.dian.gov.co/politicadefirma/v1/politicadefirmav2.pdf</xades:Identifier></xades:SigPolicyId><xades:SigPolicyHash><ds:DigestMethod Algorithm="http://www.w3.org/2001/04/xmlenc#sha256"/><ds:DigestValue>dMoMvtcG5aIzgYo0tIsSQeVJBDnUnfSOfBpxXrmor0Y=</ds:DigestValue></xades:SigPolicyHash></xades:SignaturePolicyId></xades:SignaturePolicyIdentifier><xades:SignerRole><xades:ClaimedRoles><xades:ClaimedRole>supplier</xades:ClaimedRole></xades:ClaimedRoles></xades:SignerRole></xades:SignedSignatureProperties></xades:SignedProperties></xades:QualifyingProperties></ds:Object>
        </ds:Signature>';
    return $xml;
}

?>
<script>
    //Imprimir
    var cufe = $('#cufe').val();
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
                cadenasSeparadas.push({
                    separadas,
                    maximaLongitud: contenido.maximaLongitud
                });
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
                const nombreImpresora = "caja";
                if (!nombreImpresora) {
                    return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
                }
                imprimirTabla("caja");
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
                    [{
                            contenido: "-",
                            maximaLongitud: maximaLongitudNombre
                        },
                        {
                            contenido: "-",
                            maximaLongitud: maximaLongitudCantidad
                        },
                        {
                            contenido: "-",
                            maximaLongitud: maximaLongitudPrecio
                        },
                        {
                            contenido: "-",
                            maximaLongitud: maximaLongitudPrecioTotal
                        },
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
                ?> {
                        nombre: "<?php echo $value['nombre_producto'] ?>",
                        cantidad: "<?php if ($value['cantidad'] > 0) {
                                        echo $value['cantidad'];
                                    } else {
                                        echo $value['peso'];
                                    } ?>",
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

                    {
                        contenido: "Nombre",
                        maximaLongitud: maximaLongitudNombre
                    },
                    {
                        contenido: "Cantidad",
                        maximaLongitud: maximaLongitudCantidad
                    },
                    {
                        contenido: "Precio",
                        maximaLongitud: maximaLongitudPrecio
                    },
                    {
                        contenido: "Total",
                        maximaLongitud: maximaLongitudPrecioTotal
                    },
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
                    [{
                            contenido: producto.nombre,
                            maximaLongitud: maximaLongitudNombre
                        },
                        {
                            contenido: producto.cantidad.toString(),
                            maximaLongitud: maximaLongitudCantidad
                        },
                        {
                            contenido: producto.precio.toString(),
                            maximaLongitud: maximaLongitudPrecio
                        },
                        {
                            contenido: producto.precioTotal.toString(),
                            maximaLongitud: maximaLongitudPrecio
                        },
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
            <?php
            if (isset($_SESSION['factura'])) {
                if ($_SESSION['factura'] == 'true') {
                    if ($resFactura[0]['factura'] == "true") {
            ?>
                            .TextoSegunPaginaDeCodigos(2, "cp850", "SEBASTIAN\n")
            <?php
                    }
                }
            }
            ?>
                .TextoSegunPaginaDeCodigos(2, "cp850", "Número Factura: <?php echo $resFactura[0]['id_factura'] ?>\n")
                .EscribirTexto("Fecha: " + (new Intl.DateTimeFormat("es-MX").format(new Date())))
                .EscribirTexto("<?php echo $nombreSistema ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Nit: <?php echo $nit ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Teléfono: <?php echo $tel ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Direccion: <?php echo $dire ?>\n")
            <?php
            if (isset($_SESSION['factura'])) {
                if ($_SESSION['factura'] == 'true') {
                    if ($resFactura[0]['factura'] == "true") {
            ?>
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Factura Electrónica de venta <?php echo $resFactura[0]['id_factura'] ?>\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Fecha: " + (new Intl.DateTimeFormat("es-MX").format(new Date())))
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Vence: " + (new Intl.DateTimeFormat("es-MX").format(new Date())))
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Impreso: " + (new Intl.DateTimeFormat("es-MX").format(new Date())))
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Vendedor: rafipanespinal@gmail.com\n")
                            .EscribirTexto("------------------------------------------------\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Adquiriente: <?php echo $resCliente[0]['primer_nombre'] . " " . $resCliente[0]['primer_apellido'] ?>\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Identificación: <?php echo $resCliente[0]['numero_cc'] ?>\n")
            <?php
                    }
                }
            }
            ?>
                .EscribirTexto("------------------------------------------------\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Nombre o Razón social: <?php echo $resCliente[0]['primer_nombre'] . " " . $resCliente[0]['primer_apellido'] ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "CC y/o NIT: <?php echo $resCliente[0]['numero_cc'] ?>\n")
                .EscribirTexto("------------------------------------------------\n")
                .Feed(1)
                .EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
                .EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
                .EscribirTexto(tabla)
                .EscribirTexto("------------------------------------------------\n")
                .EscribirTexto("SubTotal $<?php echo number_format($resFactura[0]['total_factura'] - (isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0), 0) ?>\n")
                .EscribirTexto("Propina $<?php echo number_format(isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0, 0) ?>\n")
                .EscribirTexto("Total $<?php echo number_format($resFactura[0]['total_factura'], 2) ?>\n")
                .EscribirTexto("------------------------------------------------\n")
                .EscribirTexto("Pago <?php echo $resFactura[0]['efectivo'] ?>   Cambio: <?php echo number_format($resFactura[0]['cambio'], 0) ?>\n")
                .EscribirTexto("------------------------------------------------\n")
                .EstablecerAlineacion(ConectorPluginV3.ALINEACION_CENTRO)
                .TextoSegunPaginaDeCodigos(2, "cp850", "GRACIAS POR SU COMPRA\n")
            <?php
            if (isset($_SESSION['factura'])) {
                if ($_SESSION['factura'] == 'true') {
                    if ($resFactura[0]['factura'] == "true") {
            ?>
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Resolución DIAN Nro: 18764084082433\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "FECHA: " + (new Intl.DateTimeFormat("es-MX").format(new Date())) + "\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "PREFIJO FF\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "RANGO DEL FF1 AL FF 10000\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "CUFE: " + cufe + "\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Representación impresa de Factrua Electronica de Venta\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Software CREATIVETEC fabricado por CREATIVETEC\n")
                            .TextoSegunPaginaDeCodigos(2, "cp850", "Contacto: 3122146368\n")
            <?php
                    }
                }
            }
            ?>

                .Feed(3)
                .Corte(1)
                .Pulso(48, 60, 120)
                .imprimirEn("caja");
            if (respuesta === true) {
                alert("Impreso correctamente");
            } else {
                alert("Error: " + respuesta);
            }
        }
        init();
    });
</script>