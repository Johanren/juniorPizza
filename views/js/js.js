//Imprimir Pedido Cocina
document.addEventListener('DOMContentLoaded', function () {
	// Este código se ejecutará cuando la página haya cargado completamente
	var boton = document.getElementById('btnImprimir');

	// Simulamos un clic en el botón después de 3 segundos
	setTimeout(function () {
		boton.click(); // Desencadenamos el evento de clic en el botón
	}, 3000); // 3000 milisegundos = 3 segundos
});

//Autocomplete
$("#proeevedor").autocomplete({
	source: function (request, response) {
		$.ajax({
			url: 'views/ajax.php',
			type: 'get',
			dataType: 'json',
			data: { proeevedor: request.term },
			success: function (data) {
				response(data);
				//console.log("el dato", data);

			}

		});
	},
	minLength: 1,
	select: function (event, ui) {
		$(this).val(ui.item.label);
		$("#id_proeevedor").val(ui.item.id);
		$("#nom_proeevedor").html(ui.item.nom);
		$("#nit_proeevedor").html(ui.item.nit);
		$("#tel_proeevedor").html(ui.item.tel);
		$("#dir_proeevedor").html(ui.item.dire);
		return false;
	}

});

//Autocomplete Medida ingrediente
$(document).ready(function () {
	$('body').on('keydown', '.medida', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];
		$(this).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { medida: request.term },
					success: function (data) {
						response(data);
						//console.log("el dato", data);

					}

				});
			},
			minLength: 1,
			select: function (event, ui) {
				$("#medida_" + index).val(ui.item.label);
				$("#id_medida_" + index).val(ui.item.id);
				return false;

			}

		});
	});
});

//Autocomplete Categoria
$(document).ready(function () {
	$('body').on('keydown', '.categoria', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];
		$(this).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { categoria: request.term },
					success: function (data) {
						response(data);
						//console.log("el dato", data);

					}

				});
			},
			minLength: 1,
			select: function (event, ui) {
				$("#categoria_" + index).val(ui.item.label);
				$("#id_categoria_" + index).val(ui.item.id);
				return false;

			}

		});
	});
});

//Autocomplete Local
$(document).ready(function () {
	$('body').on('keydown', '.nom_local', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];
		$(this).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { local: request.term },
					success: function (data) {
						response(data);
						//console.log("el dato", data);

					}

				});
			},
			minLength: 1,
			select: function (event, ui) {
				$("#local_" + index).val(ui.item.label);
				$("#id_local_" + index).val(ui.item.id);
				return false;

			}

		});
	});
});

//Autocomplete producto
$("#nombreProducto").autocomplete({
	source: function (request, response) {
		$.ajax({
			url: 'views/ajax.php',
			type: 'get',
			dataType: 'json',
			data: { producto: request.term },
			success: function (data) {
				response(data);
				//console.log("el dato", data);

			}

		});
	},
	minLength: 1,
	select: function (event, ui) {
		$(this).val(ui.item.label);
		$("#id_producto").val(ui.item.id);
		$("#precio").val(ui.item.precio);
		$("#codigo").val(ui.item.codigo);
		return false;
	}

});

//Autocomplete Ingrediente
$(document).ready(function () {
	$('body').on('keydown', '.ingre', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];
		$(this).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { ingrediente: request.term },
					success: function (data) {
						response(data);
						//console.log("el dato", data);

					}

				});
			},
			minLength: 1,
			select: function (event, ui) {
				$("#ingre_" + index).val(ui.item.label);
				$("#id_ingre_" + index).val(ui.item.id);
				$("#medida_" + index).val(ui.item.medida);
				return false;

			}

		});
	});
});

//Autocomplete promocio
$(document).ready(function () {
	$('body').on('keydown', '.prod', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];
		$(this).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { producto: request.term },
					success: function (data) {
						response(data);
						//console.log("el dato", data);

					}

				});
			},
			minLength: 1,
			select: function (event, ui) {
				$("#produc_" + index).val(ui.item.label);
				$("#id_prodcu_" + index).val(ui.item.id);
				$("#codigoProd_" + index).val(ui.item.codigo);
				return false;

			}

		});
	});
});

//Autocomplete pedido
$(document).ready(function () {
	$('body').on('keydown', '.producto', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];
		$(this).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { productoPedido: request.term },
					success: function (data) {
						response(data);
						//console.log("el dato", data);

					}

				});
			},
			minLength: 1,
			select: function (event, ui) {
				$("#producto_" + index).val(ui.item.label);
				$("#id_predido_" + index).val(ui.item.id);
				$("#descripcion_" + index).val(ui.item.descripcion);
				return false;

			}

		});
	});
});

//Agreagr Producto

$(document).ready(function () {
	var index = 2;
	$("#agregarProducto").click(function () {
		$("#producto").append('<tr><td><input type="text" class="form-control" name="codigo[]"></td><td><input type="text" class="form-control" name="nombre[]"></td><td><input type="text" class="form-control" name="precio[]"></td><td><input type="text" class="form-control" name="cantidad[]"></td><td><input type="hidden" class="form-control" name="id_categoria[]"id="id_categoria_' + index + '"><input type="text" class="form-control categoria"name="" id="categoria_' + index + '"></td><td><input type="hidden" class="form-control" name="id_medida[]"id="id_medida_' + index + '"><input type="text" class="form-control medida" name=""id="medida_' + index + '"></td><?php if ($_SESSION["rol"] == "Administrador") { ?><td><input type="hidden" class="form-control " name="id_local[]"id="id_local_' + index + '"><input type="text" class="form-control nom_local" id="local_' + index + '"></td><?php } ?></tr>');
		index++;
	});
});

//Agreagr ingrediente

$(document).ready(function () {
	var index = 2;
	$("#agregarIngrediente").click(function () {
		$("#ingrediente").append('<tr><td><input type="text" class="form-control" name="nom_ingre[]"></td><td><input type="text" class="form-control" name="cant[]"></td><td><input type="hidden" class="form-control" name="id_medida[]"id="id_medida_' + index + '"><input type="text" class="form-control medida" name=""id="medida_' + index + '"></td></tr>');
		index++;
	});
});

//Agreagr ingrediente&procuto

$(document).ready(function () {
	var index = 2;
	$("#agregarIngredienteProducto").click(function () {
		$("#ingreprodu").append('<tr><td><input type="hidden" name="id_ingre[]" id="id_ingre_' + index + '"><input type="text"class="form-control ingre" id="ingre_' + index + '"></td><td><input type="text" class="form-control" id="medida_' + index + '"></td><td><input type="text" class="form-control" name="cantidad[]"></td></tr>');
		index++;
	});
});

$(document).ready(function () {
	var index = 3;
	$("#agregarIngredienteProduct").click(function () {
		$("#ingreprod").append('<tr><td><input type="hidden" name="id_ingre[]" id="id_ingre_' + index + '"><input type="text"class="form-control ingre" id="ingre_' + index + '"></td><td><input type="text" class="form-control" id="medida_' + index + '"></td><td><input type="text" class="form-control" name="cantidad[]"></td></tr>');
		index++;
	});
});

//Agreagr promocion&procuto

$(document).ready(function () {
	var index = 2;
	$("#agregarPromocion").click(function () {
		$("#produc").append('<tr><td><input type="hidden" name="id_prodcu[]" id="id_prodcu_' + index + '"><input type="text"class="form-control prod" id="produc_' + index + '"></td><td><input type="text" name="" id="codigoProd_' + index + '" class="form-control"></td><td><input type="text" id="" name="cantidadPromocion[]" class="form-control"></td></tr>');
		index++;
	});
});

//Agreagr pedido

$(document).ready(function () {
	var index = 2;
	$("#agregarPedido").click(function () {
		$("#pedidoProducto").append('<tr class="eliminar_' + index + '"><td><input type="hidden" name="id_pedido[]" id="id_predido_' + index + '"><input type="text"name="producto[]" class="form-control producto" id="producto_' + index + '"placeholder="Producto"></td><th><textarea name="descripcion[]" id="descripcion_' + index + '" class="form-control" cols="30"rows="1"></textarea></th><th><input type="number" name="cantidad[]" class="form-control"placeholder="Cantidad Pedido"></th><th><a class="btn btn-primary eliminar" id="eliminarFactura"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" /></svg></a></th></tr>');
		index++;
	});
});

//revome
for (let index = 0; index < 30; index++) {

	$(document).on('click', '.eliminar', function () {
		$(this).parents('.eliminar_' + index + '').remove();
	})
}

//habilitar inputs
function habilitarInput() {
	var inputs = document.getElementsByClassName("inputs");
	for (var i = 0; i < inputs.length; i++) {
		if (inputs[i].disabled) {
			inputs[i].disabled = false;
			var boton = document.getElementById("miBoton");
			boton.innerHTML = "Inabilitar campos";
		} else {
			inputs[i].disabled = true;
			var boton = document.getElementById("miBoton");
			boton.innerHTML = "Habilitar campos";
		}
	}
}

//actualizar funciones

$('input[type="checkbox"]').on('change', function () {
	var datos = {};
	$('input[type="checkbox"]').each(function () {
		datos[$(this).attr('id')] = $(this).is(':checked');
		console.log(datos);
	});

	$.ajax({
		url: 'views/actualizar.php',
		type: 'POST',
		data: datos,
		success: function (response) {
			$('#mensaje').text(response);
			window.location = "configuracion"
		},
		error: function (xhr, status, error) {
			console.error(xhr.responseText);
		}
	});
});
//Multiplicar factura valor * cantidad
$(document).ready(function () {
	$(document).on('keydown', '.cantidad', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		var valor_descuento = 0/*document.getElementById('descuento_' + index + '').value*/;
		var valor = document.getElementById('valor_' + index + '').value;
		let cantidad = document.getElementById('cantidad_' + index + '');
		cantidad.addEventListener("keyup", function () {
			if (valor_descuento > 0) {

			} else {
				var result = parseInt(valor) * parseInt(this.value);
				document.getElementById('resultado_' + index).value = result;
				let valor_total_elems = document.querySelectorAll('#resultado_' + index + '')
				let suma = 0
				valor_total_elems.forEach(e => suma += parseInt(e.value))

				document.querySelector('#total_1').value = suma
			}
		});
	});
});
//sumar factura
$(document).ready(function () {
	$(document).on('keydown', '.cantidad', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		let cantidad = document.getElementById('cantidad_' + index + '');
		cantidad.addEventListener("keyup", function () {
			let valor_total_elems = document.querySelectorAll('.resultado')
			let suma = 0
			valor_total_elems.forEach(e => suma += parseInt(e.value))
			console.log(suma);
			document.querySelector('#total_1').value = suma
		});
	});
});

//sumar factura auto
$(document).ready(function () {
	let valor_total_elems = document.querySelectorAll('.resultado')
	let suma = 0
	valor_total_elems.forEach(e => suma += parseInt(e.value))
	//console.log(suma);
	document.querySelector('#total_1').value = suma
});

//cambio
$(document).ready(function () {
	$(document).on('change', '#pago_1', function () {

		var valorCampo = $('#total_1').val();
		var pago = $('#pago_1').val();
		//console.log(pago);
		resta = parseInt(this.value) - valorCampo;
		//console.log(resta)
		document.querySelector('#cambio_1').value = resta
	});
});

//Seleccion metodo de pago
$(document).ready(function () {
	// Cuando se cambia el método de pago
	$('#metodo').on('change', function () {
		var metodoPago = $(this).val(); // Obtenemos el valor seleccionado del método de pago
		//console.log(metodoPago);
		// Si el método de pago es "efectivo"
		if (metodoPago === 'efectivo') {
			// Habilitar el campo de monto a pagar
			$('#pago_1').prop('disabled', false);
		} else {
			// Si es cualquier otro método de pago
			// Inhabilitar el campo de monto a pagar
			$('#pago_1').prop('disabled', false);

			// Calcular el total y establecerlo como el monto a pagar
			var total = calcularTotal();
			//console.log(total);
			$('#pago_1').val(total);
			var valorCampo = $('#total_1').val();
			var pago = $('#pago_1').val();
			//console.log(pago);
			resta = parseInt(pago) - total;
			//console.log(resta)
			document.querySelector('#cambio_1').value = resta
		}
	});

	function calcularTotal() {
		// Recorrer todos los campos de resultado y sumar sus valores
		let valor_total_elems = document.querySelectorAll('.resultado')
		let suma = 0
		valor_total_elems.forEach(e => suma += parseInt(e.value))
		//console.log(suma);
		return suma;
	}
});

//agregar factura

$(document).ready(function () {
	var index = 2;
	$("#agregarFactura").click(function () {
		$("#factura").append('<tr class="eliminar_' + index + '"><td><input type="hidden" name="id_articulo[]" id="id_articulo_' + index + '"><input type="text" name="codigo" class="form-control codigo_articulo" id="codigo_' + index + '" placeholder="Codigo producto"></td><td><input type="text" name="articulo" class="form-control nombre_articulo" id="nombre_' + index + '" placeholder="Nombre producto"></td><td><input type="text" name="precio" class="form-control" id="valor_' + index + '" disabled></td><!--<td><input type="text" name="descuento[]" class="form-control" id="descuento_' + index + '" value="0"></td>--><!--<td><input type="text" name="peso[]" class="form-control peso" id="peso_' + index + '" value="0" required>--><td><input type="text" name="cantidad[]" class="form-control cantidad" id="cantidad_' + index + '" value="0" required></td><td><input type="text" name="total" class="form-control resultado" id="resultado_' + index + '" disabled></td><td><a class="btn btn-primary mt-3 eliminar" id="eliminarFactura">Eliminar</a></td></tr>');
		index++;
	});
});
//revome
for (let index = 0; index < 30; index++) {

	$(document).on('click', '.eliminar', function () {
		let valor_total_elems = document.querySelectorAll('.resultado')
		let suma = 0
		valor_total_elems.forEach(e => suma += parseInt(e.value))
		//console.log(suma);
		document.querySelector('#total_1').value = suma
		$(this).parents('.eliminar_' + index + '').remove();
	})
}

//autocomplete numero cc

$('body').on('click', '#cc', function () {
	$(this).autocomplete({
		source: function (request, response) {
			$.ajax({
				url: 'Views/ajax.php',
				type: 'get',
				dataType: 'json',
				data: { cc: request.term },
				success: function (data) {
					response(data);
					console.log("el dato", data);

				}

			});
		},
		minLength: 1,
		select: function (event, ui) {
			$(this).val(ui.item.label1);
			$("#cliente").val(ui.item.label);
			$("#id_cliente").val(ui.item.id);
			return false;
		}

	});
});

//agregar factura nombre

$(document).ready(function () {

	$(document).on('keydown', '.nombre_articulo', function () {

		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		$('#' + id).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { nombre: request.term },
					success: function (data) {
						response(data);
						console.log("el dato", data);
					}

				});
			}, select: function (event, ui) {
				$(this).val(ui.item.labelN); // display the selected text
				var userid = ui.item.value; // selected id to input

				// AJAX
				$.ajax({
					url: 'Views/ajax.php',
					type: 'get',
					data: { userid: userid, request: 2 },
					dataType: 'json',
					success: function (data) {

						var len = data.length;
						if (len > 0) {
							var id = data[0]['id_producto'];
							var codigo = data[0]['codigo_producto'];
							var name = data[0]['nombre_producto'];
							var valor = data[0]['precio_unitario'];

							document.getElementById('id_articulo_' + index).value = id;
							document.getElementById('codigo_' + index).value = codigo;
							document.getElementById('nombre_' + index).value = name;
							document.getElementById('valor_' + index).value = valor;
						}

					}
				});

				return false;
			}
		});
	});
});

//teclas especiales
document.addEventListener('keydown', function (event) {
	//agregar factura
	if (event.key === 'F2') {
		var urlActual = window.location.href;
		var hosting = window.location.hostname;
		//console.log(hosting);
		if (urlActual == "http://"+hosting+"/inventario/agregarArticulo") {
			document.getElementById("agregarArticulo").click();
		} else {
			document.getElementById("agregarFactura").click();
		}

	}
	//eliminar columna factura
	if (event.key === 'F4') {
		document.getElementById("eliminarFactura").click();
	}
});