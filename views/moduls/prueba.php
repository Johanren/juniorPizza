<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Trabajo con Firmas Digitales</title>
    <style>
        form {
            max-width: 800px;
            margin: auto;
        }
        table {
            width: 100%;
            margin-bottom: 16px;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        input[type="text"],
        input[type="datetime-local"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .signature-pad {
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f2f2f2;
            height: 150px;
        }
        button {
            padding: 8px 12px;
            margin-top: 8px;
            border: none;
            border-radius: 4px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <form action="save_signatures.php" method="post" id="workOrderForm">
        <!-- Form content as provided -->

        <div class="row mt-2">
            <div class="col">
                <label>Firma del Cliente:</label>
                <div class="signature-pad" id="signature-pad-client">
                    <canvas></canvas>
                </div>
                <button type="button" id="clear-client">Borrar Firma</button>
            </div>
            <div class="col">
                <label>Firma del Técnico:</label>
                <div class="signature-pad" id="signature-pad-tech">
                    <canvas></canvas>
                </div>
                <button type="button" id="clear-tech">Borrar Firma</button>
            </div>
            <div class="col">
                <label>Firma de Entrega del Vehículo:</label>
                <div class="signature-pad" id="signature-pad-vehicle">
                    <canvas></canvas>
                </div>
                <button type="button" id="clear-vehicle">Borrar Firma</button>
            </div>
        </div>

        <input type="submit" value="Enviar">
    </form>

    <!-- Incluir la biblioteca Signature Pad -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script>
        // Configuración de Signature Pad para cada campo
        function setupSignaturePad(id, clearButtonId) {
            var canvas = document.querySelector(id + " canvas");
            var signaturePad = new SignaturePad(canvas);

            function resizeCanvas() {
                var ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
                signaturePad.clear(); // No olvidar borrar la firma
            }

            window.onresize = resizeCanvas;
            resizeCanvas();

            document.getElementById(clearButtonId).addEventListener("click", function () {
                signaturePad.clear();
            });

            return signaturePad;
        }

        var signaturePadClient = setupSignaturePad("#signature-pad-client", "clear-client");
        var signaturePadTech = setupSignaturePad("#signature-pad-tech", "clear-tech");
        var signaturePadVehicle = setupSignaturePad("#signature-pad-vehicle", "clear-vehicle");

        document.getElementById("workOrderForm").addEventListener("submit", function (event) {
            if (signaturePadClient.isEmpty() || signaturePadTech.isEmpty() || signaturePadVehicle.isEmpty()) {
                alert("Por favor, firme en todos los campos antes de enviar.");
                event.preventDefault();
            } else {
                var clientSignature = signaturePadClient.toDataURL();
                var techSignature = signaturePadTech.toDataURL();
                var vehicleSignature = signaturePadVehicle.toDataURL();

                // Agregar las firmas al formulario como campos ocultos
                var inputClientSignature = document.createElement("input");
                inputClientSignature.type = "hidden";
                inputClientSignature.name = "clientSignature";
                inputClientSignature.value = clientSignature;
                this.appendChild(inputClientSignature);

                var inputTechSignature = document.createElement("input");
                inputTechSignature.type = "hidden";
                inputTechSignature.name = "techSignature";
                inputTechSignature.value = techSignature;
                this.appendChild(inputTechSignature);

                var inputVehicleSignature = document.createElement("input");
                inputVehicleSignature.type = "hidden";
                inputVehicleSignature.name = "vehicleSignature";
                inputVehicleSignature.value = vehicleSignature;
                this.appendChild(inputVehicleSignature);
            }
        });
    </script>
</body>
</html>
