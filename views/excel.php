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
require '../vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_GET['producto'])) {
    $id = $_GET['producto'] ?? 0;
    $conn = new mysqli("localhost", "root", "", "junior");
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT 
    proeevedor.nombre_proeevedor AS nombre_proveedor, 
    producto.codigo_producto, 
    producto.nombre_producto, 
    producto.precio_unitario, 
    producto.cantidad_producto, 
    categoria.nombre_categoria, 
    medida.nombre_medida, 
    local.nombre_local 
    FROM producto 
    INNER JOIN proeevedor ON proeevedor.id_proeevedor = producto.id_proeevedor 
    INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria 
    INNER JOIN medida ON medida.id_medida = producto.id_medida 
    INNER JOIN local ON local.id_local = producto.id_local 
    WHERE producto.id_local = $id";

    $result = $conn->query($sql);

    // === 1. CREAR EXCEL ===
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->fromArray(['Proveedor', 'Codigo', 'Producto', 'Precio unitario', 'Cantidad', 'Categoria', 'Medida', 'Local'], null, 'A1');

    $row = 2;
    $productos = [];

    while ($data = $result->fetch_assoc()) {
        $sheet->fromArray([
            $data['nombre_proveedor'],
            $data['codigo_producto'],
            $data['nombre_producto'],
            number_format($data['precio_unitario'], 2),
            $data['cantidad_producto'],
            $data['nombre_categoria'],
            $data['nombre_medida'],
            $data['nombre_local'],
        ], null, 'A' . $row);

        $productos[] = [
            'codigo' => $data['codigo_producto'],
            'nombre' => $data['nombre_producto'],
        ];

        $row++;
    }

    $excelFile = sys_get_temp_dir() . '/productos_' . uniqid() . '.xlsx';
    $writer = new Xlsx($spreadsheet);
    $writer->save($excelFile);

    // === 2. CREAR PDF DE ETIQUETAS ===
    $pdf = new TCPDF('P', 'mm', 'A4');
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false, 0);

    $labelsPerRow = 3;
    $labelWidth = 60;
    $labelHeight = 40;

    $x = 10;
    $y = 10;
    $currentColumn = 0;

    foreach ($productos as $item) {
        $codigo = $item['codigo'];
        $nombre = $item['nombre'];

        // Nombre del producto
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetXY($x, $y + 2);
        $pdf->MultiCell($labelWidth, 5, $nombre, 0, 'C', false);

        // Código de barras centrado
        $barcodeWidth = $labelWidth - 20; // ancho más pequeño para dejar márgenes
        $barcodeX = $x + ($labelWidth - $barcodeWidth) / 2;
        $style = [
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => false,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 0,
            'vpadding' => 0,
            'fgcolor' => [0, 0, 0],
            'bgcolor' => false,
            'text' => false,
        ];
        $pdf->write1DBarcode($codigo, 'C128', $barcodeX, $y + 13, $barcodeWidth, 12, 0.4, $style, 'C');

        // Código numérico centrado
        $pdf->SetFont('helvetica', '', 7);
        $pdf->SetXY($x, $y + 28);
        $pdf->Cell($labelWidth, 5, $codigo, 0, 0, 'C');

        // Mover posición
        $currentColumn++;
        if ($currentColumn >= $labelsPerRow) {
            $currentColumn = 0;
            $x = 10;
            $y += $labelHeight + 5;
            if ($y + $labelHeight > 280) {
                $pdf->AddPage();
                $y = 10;
            }
        } else {
            $x += $labelWidth + 5;
        }
    }


    $pdfFile = sys_get_temp_dir() . '/etiquetas_' . uniqid() . '.pdf';
    $pdf->Output($pdfFile, 'F');

    // === 3. CREAR ZIP CON AMBOS ===
    $zipFile = sys_get_temp_dir() . '/productos_completos_' . uniqid() . '.zip';
    $zip = new ZipArchive();
    $zip->open($zipFile, ZipArchive::CREATE);
    $zip->addFile($excelFile, 'productos.xlsx');
    $zip->addFile($pdfFile, 'etiquetas_codigos.pdf');
    $zip->close();

    // === 4. FORZAR DESCARGA ZIP ===
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="productos_completos.zip"');
    header('Content-Length: ' . filesize($zipFile));
    readfile($zipFile);

    // === 5. LIMPIAR TEMPORALES ===
    unlink($excelFile);
    unlink($pdfFile);
    unlink($zipFile);
    exit;
}
if (isset($_GET['ingrediente'])) {
    $id = $_GET['ingrediente'];
    // Crear una nueva instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar los encabezados de la tabla
    $sheet->setCellValue('A1', 'Ingrediente');
    $sheet->setCellValue('B1', 'Medida');
    $sheet->setCellValue('C1', 'Cantidad');

    // Conectar a la base de datos y recuperar los datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "junior";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT ingrediente.nombre_ingrediente, ingrediente.cantidad, medida.nombre_medida FROM ingrediente INNER JOIN medida ON medida.id_medida = ingrediente.id_medida WHERE ingrediente.id_local = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = 2; // Empezar desde la fila 2 ya que la fila 1 contiene los encabezados
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['nombre_ingrediente']);
            $sheet->setCellValue('B' . $row, $data['nombre_medida']);
            $sheet->setCellValue('C' . $row, $data['cantidad']);
            $row++;
        }
    }

    $conn->close();

    // Crear el archivo Excel
    $writer = new Xlsx($spreadsheet);

    // Configurar los encabezados HTTP para la descarga del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="productos.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit;
}
if (isset($_GET['productoMes'])) {
    $id = $_GET['productoMes'];
    // Crear una nueva instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar los encabezados de la tabla
    $sheet->setCellValue('A1', 'Producto');
    $sheet->setCellValue('B1', 'Total Vendido');

    // Conectar a la base de datos y recuperar los datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "junior";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    $fecha_inicio = $_GET['inicio'];
    $fecha_fin = $_GET['fin'];
    $sql = "SELECT producto.nombre_producto, SUM(cantidad) AS total_vendido FROM venta INNER JOIN producto ON producto.id_producto = venta.id_producto WHERE venta.fecha_ingreso BETWEEN '$fecha_inicio' AND '$fecha_fin' AND venta.id_local = $id GROUP BY producto.nombre_producto ORDER BY total_vendido;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = 2; // Empezar desde la fila 2 ya que la fila 1 contiene los encabezados
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['nombre_producto']);
            $sheet->setCellValue('B' . $row, number_format($data['total_vendido'], 0));
            $row++;
        }
    }

    $conn->close();

    // Crear el archivo Excel
    $writer = new Xlsx($spreadsheet);

    // Configurar los encabezados HTTP para la descarga del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="productosVendidoMes.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit;
}

if (isset($_GET['ventaMes'])) {
    $id = $_GET['ventaMes'];
    // Crear una nueva instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar los encabezados de la tabla
    $sheet->setCellValue('A1', 'Fecha');
    $sheet->setCellValue('B1', 'Total Vendido');

    // Conectar a la base de datos y recuperar los datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "junior";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    $fecha = $_GET['mes'] . "%";
    $sql = "SELECT DATE(fecha_ingreso) AS dia_facturado, SUM(precio_compra) AS total FROM `venta` WHERE fecha_ingreso LIKE '$fecha' AND id_local = $id GROUP BY DATE(fecha_ingreso) ORDER BY DATE(fecha_ingreso)";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = 2; // Empezar desde la fila 2 ya que la fila 1 contiene los encabezados
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['dia_facturado']);
            $sheet->setCellValue('B' . $row, number_format($data['total'], 0));
            $row++;
        }
    }

    $conn->close();

    // Crear el archivo Excel
    $writer = new Xlsx($spreadsheet);

    // Configurar los encabezados HTTP para la descarga del archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ventaMes.xlsx"');
    header('Cache-Control: max-age=0');

    // Enviar el archivo al navegador
    $writer->save('php://output');
    exit;
}


if (isset($_POST['inicio'])) {

    // Verificar si los datos POST están presentes
    if (isset($_POST['inicio']) && isset($_POST['fin'])) {
        $fechaInicio = $_POST['inicio'];
        $fechaFin = $_POST['fin'];

        // Aquí deberías hacer tu consulta a la base de datos usando $fechaInicio y $fechaFin
        // Simulación de datos (reemplaza esto con tu consulta real)

        $venta = new ControladorVenta();
        $res = $venta->informeVentaInicioFinExcel($fechaInicio, $fechaFin);
        $resFactura = $venta->informeVentainicioFinFactura($fechaInicio, $fechaFin);

        // Crear nuevo objeto Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Configurar las cabeceras
        $sheet->setCellValue('A2', 'Desde:');
        $sheet->setCellValue('B2', 'Hasta:');
        $sheet->setCellValue('A3', $fechaInicio);
        $sheet->setCellValue('B3', $fechaFin);

        $sheet->setCellValue('D2', 'Resolución');
        $sheet->setCellValue('D3', '18764084082433');

        $sheet->setCellValue('F2', 'Factura Desde');
        $sheet->setCellValue('F3', $resFactura[0]['MIN(factura.id_factura)']);

        $sheet->setCellValue('G2', 'Factura Hasta');
        $sheet->setCellValue('G3', $resFactura[0]['MAX(factura.id_factura)']);
        // Encabezados de la tabla en el Excel
        $sheet->setCellValue('A5', 'Descripcion');
        $sheet->setCellValue('B5', 'Impuesto');
        $sheet->setCellValue('C5', 'Base');
        $sheet->setCellValue('D5', 'Valor Impuesto');
        $sheet->setCellValue('E5', 'Total Impuesto');

        // Variables para totales
        $totalsuma = 0;
        $totalsumavalor = 0;
        $base = 0;

        // Si los resultados están disponibles
        if (!empty($res)) {
            $row = 6; // Inicia en la fila 6 después de los encabezados
            foreach ($res as $value) {
                // Calcular porcentaje e impuesto
                $porjentaje = $value['base_impuesto'] / 100;
                $impuesto = $porjentaje * $value['total_pago'];
                $total = $impuesto + $value['total_pago'];

                // Sumar los totales
                $totalsuma += $total;
                $totalsumavalor += $impuesto;
                $base += $value['total_pago'];

                // Escribir los datos en las celdas del Excel
                $sheet->setCellValue('A' . $row, $value['nombre_producto']);
                $sheet->setCellValue('B' . $row, "0" . $value['numero_impuesto'] . " " . $value['nombre_impusto']);
                $sheet->setCellValue('C' . $row, number_format($value['total_pago'], 0));
                $sheet->setCellValue('D' . $row, number_format($impuesto, 0));
                $sheet->setCellValue('E' . $row, number_format($total, 0));

                $row++;
            }

            // Agregar los totales
            $sheet->setCellValue('A' . $row, 'Total Impuesto');
            $sheet->setCellValue('C' . $row, number_format($base, 0));
            $sheet->setCellValue('D' . $row, number_format($totalsumavalor, 0));
            $sheet->setCellValue('E' . $row, number_format($totalsuma, 0));
        }

        // Establecer el nombre del archivo y enviar el Excel al navegador
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Informe_Venta_Electronico.xlsx"');
        header('Cache-Control: max-age=0');

        // Crear archivo Excel
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    } else {
        echo "No se recibieron fechas.";
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "junior";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha subido un archivo
if (isset($_FILES['file']['name'])) {
    $fileName = $_FILES['file']['tmp_name'];
    if (isset($_POST['pagina']) && $_POST['pagina'] == 'producto') {
        // Obtener el id_local enviado por el formulario
        $id_local = isset($_POST['id_local']) ? (int)$_POST['id_local'] : 0;

        // Cargar el archivo de Excel
        $spreadsheet = IOFactory::load($fileName);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        // Recorrer los datos del archivo Excel y guardarlos en la base de datos
        foreach ($data as $key => $row) {
            if ($key == 0) continue; // Saltar la primera fila (encabezado)
            // Verificar que todos los campos obligatorios tengan datos, permitiendo que el precio sea 0
            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2]) && !empty($row[4]) && !empty($row[5]) && !empty($row[6])) {

                $id_proveedor = $row[0];
                $codigo = $row[1];
                $nombre = $row[2];
                $precio = $row[3]; // Este puede ser 0
                $cantidad = $row[4];
                $id_categoria = $row[5];
                $id_medida = $row[6];

                // Verificar si el producto ya existe
                $checkSql = "SELECT * FROM producto WHERE nombre_producto = ? AND id_local = ?";
                if ($checkStmt = $conn->prepare($checkSql)) {
                    $checkStmt->bind_param("si", $nombre, $id_local);
                    $checkStmt->execute();
                    $result = $checkStmt->get_result();

                    if ($result->num_rows > 0) {
                        // Si existe, actualizar el producto
                        $updateSql = "UPDATE producto SET id_proeevedor = ?, codigo_producto = ?, precio_unitario = ?, cantidad_producto = ?, id_categoria = ?, id_medida = ? WHERE nombre_producto = ? AND id_local = ?";
                        if ($updateStmt = $conn->prepare($updateSql)) {
                            $updateStmt->bind_param("issiiisi", $id_proveedor, $codigo, $precio, $cantidad, $id_categoria, $id_medida, $nombre, $id_local);
                            if (!$updateStmt->execute()) {
                                echo "Error al actualizar el producto: " . $updateStmt->error;
                            }
                        } else {
                            echo "Error en la preparación de la consulta de actualización: " . $conn->error;
                        }
                    } else {
                        // Si no existe, insertar el nuevo producto
                        $insertSql = "INSERT INTO producto (id_proeevedor, codigo_producto, nombre_producto, precio_unitario, cantidad_producto, id_categoria, id_medida, id_local)
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                        if ($insertStmt = $conn->prepare($insertSql)) {
                            $insertStmt->bind_param("issdiiii", $id_proveedor, $codigo, $nombre, $precio, $cantidad, $id_categoria, $id_medida, $id_local);
                            if (!$insertStmt->execute()) {
                                echo "Error al insertar el producto: " . $insertStmt->error;
                            }
                        } else {
                            echo "Error en la preparación de la consulta de inserción: " . $conn->error;
                        }
                    }

                    $checkStmt->close();
                } else {
                    echo "Error en la preparación de la consulta de verificación: " . $conn->error;
                }
            }
        }

        echo "Carga completada";
    }
    if (isset($_POST['pagina']) && $_POST['pagina'] == 'ingrediente') {
        // Obtener el id_local enviado por el formulario
        $id_local = isset($_POST['id_local']) ? (int)$_POST['id_local'] : 0;
        // Cargar el archivo de Excel
        $spreadsheet = IOFactory::load($fileName);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        // Recorrer los datos del archivo Excel y guardarlos en la base de datos
        foreach ($data as $key => $row) {
            if ($key == 0) continue; // Saltar la primera fila (encabezado)

            // Verificar que los campos obligatorios tengan datos
            if (!empty($row[0]) && !empty($row[1]) && !empty($row[2])) {
                $nombre_ingrediente = $row[0]; // Nombre del ingrediente
                $id_medida = (int) $row[1]; // ID de la unidad de medida
                $cantidad = (float) $row[2]; // Cantidad del ingrediente

                // Verificar si el ingrediente ya existe en el mismo local
                $checkSql = "SELECT * FROM ingrediente WHERE nombre_ingrediente = ? AND id_local = ?";
                if ($checkStmt = $conn->prepare($checkSql)) {
                    $checkStmt->bind_param("si", $nombre_ingrediente, $id_local);
                    $checkStmt->execute();
                    $result = $checkStmt->get_result();

                    if ($result->num_rows > 0) {
                        // Si existe, actualizar el ingrediente
                        $updateSql = "UPDATE ingrediente SET id_medida = ?, cantidad = ? WHERE nombre_ingrediente = ? AND id_local = ?";
                        if ($updateStmt = $conn->prepare($updateSql)) {
                            $updateStmt->bind_param("dssi", $id_medida, $cantidad, $nombre_ingrediente, $id_local);
                            if (!$updateStmt->execute()) {
                                echo "Error al actualizar el ingrediente: " . $updateStmt->error;
                            }
                        } else {
                            echo "Error en la consulta de actualización: " . $conn->error;
                        }
                    } else {
                        // Si no existe, insertar el nuevo ingrediente
                        $insertSql = "INSERT INTO ingrediente (nombre_ingrediente, id_medida, cantidad, id_local) VALUES (?, ?, ?, ?)";
                        if ($insertStmt = $conn->prepare($insertSql)) {
                            $insertStmt->bind_param("sidi", $nombre_ingrediente, $id_medida, $cantidad, $id_local);
                            if (!$insertStmt->execute()) {
                                echo "Error al insertar el ingrediente: " . $insertStmt->error;
                            }
                        } else {
                            echo "Error en la consulta de inserción: " . $conn->error;
                        }
                    }

                    $checkStmt->close();
                } else {
                    echo "Error en la consulta de verificación: " . $conn->error;
                }
            }
        }

        echo "Carga de ingredientes completada.";
    } else {
        echo "Error al subir el archivo.";
    }
} else {
    echo "No se ha subido ningún archivo.";
}

$conn->close();
