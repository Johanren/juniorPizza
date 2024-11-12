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
    $id = $_GET['producto'];
    // Crear una nueva instancia de Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Agregar los encabezados de la tabla
    $sheet->setCellValue('A1', 'Proveedor');
    $sheet->setCellValue('B1', 'Codigo');
    $sheet->setCellValue('C1', 'Producto');
    $sheet->setCellValue('D1', 'Precio unitario');
    $sheet->setCellValue('E1', 'Cantidad');
    $sheet->setCellValue('F1', 'Categoria');
    $sheet->setCellValue('G1', 'Medida');
    $sheet->setCellValue('H1', 'Local');

    // Conectar a la base de datos y recuperar los datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "junior";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT proeevedor.nombre_proeevedor AS nombre_proveedor, producto.codigo_producto, producto.nombre_producto, producto.precio_unitario, producto.cantidad_producto, categoria.nombre_categoria, medida.nombre_medida, local.nombre_local FROM producto INNER JOIN proeevedor ON proeevedor.id_proeevedor = producto.id_proeevedor INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria INNER JOIN medida ON medida.id_medida = producto.id_medida INNER JOIN local ON local.id_local = producto.id_local WHERE producto.id_local = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = 2; // Empezar desde la fila 2 ya que la fila 1 contiene los encabezados
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['nombre_proveedor']);
            $sheet->setCellValue('B' . $row, $data['codigo_producto']);
            $sheet->setCellValue('C' . $row, $data['nombre_producto']);
            $sheet->setCellValue('D' . $row, number_format($data['precio_unitario'], 2));
            $sheet->setCellValue('E' . $row, $data['cantidad_producto']);
            $sheet->setCellValue('F' . $row, $data['nombre_categoria']);
            $sheet->setCellValue('G' . $row, $data['nombre_medida']);
            $sheet->setCellValue('H' . $row, $data['nombre_local']);
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
    $fecha = date('Y-m') . "%";
    $sql = "SELECT producto.nombre_producto, SUM(cantidad) AS total_vendido FROM `venta` INNER JOIN producto ON producto.id_producto = venta.id_producto WHERE fecha_ingreso like '$fecha' AND venta.id_local = $id GROUP BY producto.nombre_producto ORDER BY total_vendido";
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
    $fecha = date('Y-m') . "%";
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
        $res = $venta->informeVentaInicioFinExcel($fechaInicio,$fechaFin);

        // Crear nuevo objeto Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Configurar las cabeceras
        $sheet->setCellValue('A2', 'Desde:');
        $sheet->setCellValue('B2', 'Hasta:');
        $sheet->setCellValue('A3', $fechaInicio);
        $sheet->setCellValue('B3', $fechaFin);

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
} else {
    echo "No se ha subido ningún archivo.";
}

$conn->close();
