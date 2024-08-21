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
                <p>FACTURA N°<span id="num_factura"><?php echo $resFactura[0]['id_factura'] ?></span></p>
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
            </div>
            <button id="Imprimir" class="btn btn-primary mt-2">Imprimir</button>
            <a id="caja" href="caja" class="btn btn-primary mt-2">Caja</a>
        </div>
    </div>
</div>
<?php
//if (isset($_POST['facturar'])) {
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
$CustomerName = "25307"; //nombre cliente
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


$xml = formHeadXML() .
    formExtensionsXML($InvoiceAuthorization, $StartDate, $EndDate, $Prefix, $From, $To, $companyNit, $SoftwareID, $SoftwareSecurityCode, $AuthorizationProviderID, $QRCode) .
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

function validarXML($doc)
{

    libxml_use_internal_errors(true);

    $xml = new DOMDocument();
    $xml->loadXML($doc);
    $doc_validator = "C:/xampp/htdocs/juniorPizza/views/xmlValidator/UBL-Invoice-2.1.xsd";

    if ($xml->schemaValidate($doc_validator)) {
        echo "enviado";
    } else {
        echo getErrors();
        echo "fallo";
    }
}


function formHeadXML()
{
    $xml = '<Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:sts="dian:gov:co:facturaelectronica:Structures-2-1" xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" xmlns:xades141="http://uri.etsi.org/01903/v1.4.1#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2 http://docs.oasis-open.org/ubl/os-UBL-2.1/xsd/maindoc/UBL-Invoice-2.1.xsd">';
    return $xml;
}

function formExtensionsXML($InvoiceAuthorization, $StartDate, $EndDate, $Prefix, $From, $To, $companyNit, $SoftwareID, $SoftwareSecurityCode, $AuthorizationProviderID, $QRCode)
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
        return $xml . "</Invoice>";
    }
}
//}

?>
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
                const nombreImpresora = "Xprinter1";
                if (!nombreImpresora) {
                    return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
                }
                imprimirTabla("Xprinter1");
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
                .TextoSegunPaginaDeCodigos(2, "cp850", "Número Factura: <?php echo $resFactura[0]['id_factura'] ?>\n")
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
                .EscribirTexto("SubTotal $<?php echo number_format($resFactura[0]['total_factura'] - (isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0), 0) ?>\n")
                .EscribirTexto("Propina $<?php echo number_format(isset($resPropina[0]['valor_propinas']) ? $resPropina[0]['valor_propinas'] : 0, 0) ?>\n")
                .EscribirTexto("Total $<?php echo number_format($resFactura[0]['total_factura'], 2) ?>\n")
                .EscribirTexto("------------------------------------------------\n")
                .EscribirTexto("Pago <?php echo $resFactura[0]['efectivo'] ?>   Cambio: <?php echo number_format($resFactura[0]['cambio'], 0) ?>\n")
                .EscribirTexto("------------------------------------------------\n")
                .EscribirTexto("Cliente Final\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "Nombre y apellido: <?php echo $resCliente[0]['primer_nombre'] . " " . $resCliente[0]['primer_apellido'] ?>\n")
                .TextoSegunPaginaDeCodigos(2, "cp850", "CC: <?php echo $resCliente[0]['numero_cc'] ?>\n")
                .Feed(3)
                .Corte(1)
                .Pulso(48, 60, 120)
                .imprimirEn("Xprinter1");
            if (respuesta === true) {
                alert("Impreso correctamente");
            } else {
                alert("Error: " + respuesta);
            }
        }
        init();
    });
</script>