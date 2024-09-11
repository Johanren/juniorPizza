function hacerClic() {

	var urlActual = window.location.href;
	var hosting = window.location.hostname;
	if (urlActual == "http://" + hosting + "/juniorPizza/factura_pdf") {
		//document.getElementById('caja').click();
	}
	document.getElementById('btnImprimir').click();
	//console.log("hizo clic");
}
window.onload = function () {
	setInterval(hacerClic, 3000);
	var urlActual = window.location.href;
	var hosting = window.location.hostname;
	if (urlActual == "http://" + hosting + "/juniorPizza/factura_pdf") {
		setInterval(hacerClic, 10000);
	}
};
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

//Autocomplete producto editar
$(document).ready(function () {
	$('body').on('keydown', '.nombrePro', function () {
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
				$("#id_producto_" + index).val(ui.item.id);
				$("#codigo_" + index).val(ui.item.codigo);
				$("#producto_" + index).val(ui.item.label);
				$("#precio_" + index).val(ui.item.precio);
				$("#cantidad_" + index).val(ui.item.cantidad);
				$("#id_categoria_" + index).val(ui.item.id_categoria);
				$("#categoria_" + index).val(ui.item.nombre_categoria);
				$("#id_medida_" + index).val(ui.item.id_medida);
				$("#medida_" + index).val(ui.item.nombre_medida);
				$("#id_local_" + index).val(ui.item.id_local);
				$("#local_" + index).val(ui.item.nombre_local);
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
		$("#producto").append('<tr><td><input type="hidden" id="id_producto_' + index + '" name="id_producto[]"><input type="text" class="form-control" id="codigo_' + index + '" name="codigo[]"></td><td><input type="text" class="form-control nombrePro" id="producto_' + index + '" name="nombre[]"></td><td><input type="text" class="form-control precio_uni" id="precioUni_' + index + '" name="precioUnita[]" value="0"></td><td><input type="text" class="form-control precio" id="precio_' + index + '" name="precio[]"></td><td><input type="hidden" id="cantidad_' + index + '" name="cant[]"><input type="text" class="form-control cant" name="cantidad[]" id="cant_' + index + '"></td><td><input type="text" class="form-control Total" id="total_' + index + '" name="total[]" value="0"></td><td><input type="hidden" class="form-control" name="id_categoria[]"id="id_categoria_' + index + '"><input type="text" class="form-control categoria"name="" id="categoria_' + index + '"></td><td><input type="hidden" class="form-control" name="id_medida[]"id="id_medida_' + index + '"><input type="text" class="form-control medida" name=""id="medida_' + index + '"></td>');
		//$("#producto").append('<tr><td><input type="hidden" id="id_producto_' + index + '" name="id_producto[]" required><input type="text" class="form-control" id="codigo_' + index + '" name="codigo[]" required></td><td><input type="text" class="form-control nombrePro" id="producto_' + index + '" name="nombre[]" required></td><td><input type="text" class="form-control precio_uni" id="precioUni_' + index + '" name="precioUnita[]" value="0" required></td><td><input type="text" class="form-control precio" id="precio_' + index + '" name="precio[]" required></td><td><input type="hidden" id="cantidad_' + index + '" name="cant[]" required><input type="text" class="form-control cant" name="cantidad[]" id="cant_' + index + '" required></td><td><input type="text" class="form-control Total" id="total_' + index + '" name="total[]" value="0" required></td><td><input type="hidden" class="form-control" name="id_categoria[]"id="id_categoria_' + index + '" required><input type="text" class="form-control categoria"name="" id="categoria_' + index + '" required></td><td><input type="hidden" class="form-control" name="id_medida[]"id="id_medida_' + index + '"><input type="text" class="form-control medida" name=""id="medida_' + index + '"></td><?phpif ($_SESSION["rol"] == "Administrador") {?><td><input type="hidden" class="form-control " name="id_local[]"id="id_local_' + index + '"><input type="text" class="form-control nom_local"id="local_' + index + '" required></td><?php}?></tr>');
		index++;
	});
});

$(document).ready(function () {
	var index = 2;
	$("#agreProducto").click(function () {
		$("#productol").append('<tr><td><input type="hidden" id="id_producto_' + index + '" name="id_producto[]"><input type="text" class="form-control" id="codigo_' + index + '" name="codigo[]"></td><td><input type="text" class="form-control nombrePro" id="producto_' + index + '" name="nombre[]"></td><td><input type="text" class="form-control precio_uni" id="precioUni_' + index + '" name="precioUnita[]" value="0"></td><td><input type="text" class="form-control precio" id="precio_' + index + '" name="precio[]"></td><td><input type="hidden" id="cantidad_' + index + '" name="cant[]"><input type="text" class="form-control cant" name="cantidad[]" id="cant_' + index + '"></td><td><input type="text" class="form-control Total" id="total_' + index + '" name="total[]" value="0"></td><td><input type="hidden" class="form-control" name="id_categoria[]"id="id_categoria_' + index + '"><input type="text" class="form-control categoria"name="" id="categoria_' + index + '"></td><td><input type="hidden" class="form-control" name="id_medida[]"id="id_medida_' + index + '"><input type="text" class="form-control medida" name=""id="medida_' + index + '"></td>');
		index++;
	});
});

//Agreagr ingrediente

$(document).ready(function () {
	var index = 2;
	$("#agregarIngrediente").click(function () {
		$("#ingrediente").append('<tr><td><input type="hidden" id="id_ingre_' + index + '" name="id_ingre[]"><input type="text" class="form-control ingre" id="ingre_' + index + '" name="nom_ingre[]"></td><td><input type="hidden" name="cantidadIngre[]" id="cantidad_' + index + '"><input type="text" class="form-control" name="cant[]"></td><td><input type="hidden" class="form-control" name="id_medida[]"id="id_medida_' + index + '"><input type="text" class="form-control medida" name=""id="medida_' + index + '"></td></tr>');
		//$("#ingrediente").append('<tr><td><input type="hidden" id="id_ingre_' + index + '" name="id_ingre[]"><input type="text" class="form-control ingre" id="ingre_' + index + '" name="nom_ingre[]"></td><td><input type="hidden" name="cantidadIngre[]" id="cantidad_' + index + '"><input type="text" class="form-control" name="cant[]"></td><td><input type="hidden" class="form-control" name="id_medida[]"id="id_medida_' + index + '"><input type="text" class="form-control medida" name=""id="medida_' + index + '"></td>phpif ($_SESSION["rol"] == "Administrador") {?><td><input type="hidden" class="form-control " name="id_local[]"id="id_local_' + index + '"><input type="text" class="form-control nom_local"id="local_' + index + '"></td><?php}?></tr>');
		index++;
	});
});

$(document).ready(function () {
	var index = 2;
	$("#agregIngrediente").click(function () {
		$("#ingrediente1").append('<tr><td><input type="hidden" id="id_ingre_' + index + '" name="id_ingre[]"><input type="text" class="form-control ingre" id="ingre_' + index + '" name="nom_ingre[]"></td><td><input type="hidden" name="cantidadIngre[]" id="cantidad_' + index + '"><input type="text" class="form-control" name="cant[]"></td><td><input type="hidden" class="form-control" name="id_medida[]"id="id_medida_' + index + '"><input type="text" class="form-control medida" name=""id="medida_' + index + '"></td></tr>');
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
	var index = 40;
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

//editar promocion&procuto

$(document).ready(function () {
	var index = 40;
	$("#agregarPromocio").click(function () {
		$("#product").append('<tr><td><input type="hidden" name="id_prodcu[]" id="id_prodcu_' + index + '"><input type="text"class="form-control prod" id="produc_' + index + '"></td><td><input type="text" name="" id="codigoProd_' + index + '" class="form-control"></td><td><input type="text" id="" name="cantidadPromocion[]" class="form-control"></td></tr>');
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
var urlActual = window.location.href;
var hosting = window.location.hostname;
//console.log(hosting);
if (urlActual == "http://" + hosting + "/juniorPizza/configuracion") {
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
}

//Multiplicar factura valor * cantidad
$(document).ready(function () {
	$(document).on('keydown', '.cantidad', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		var valor_descuento = 0/*document.getElementById('descuento_' + index + '').value*/;
		var valor = document.getElementById('valor_' + index + '').value;
		//eliminar miles
		var valorSinDesimal = valor.replace(/,/g, '');
		let cantidad = document.getElementById('cantidad_' + index + '');
		cantidad.addEventListener("keyup", function () {
			if (valor_descuento > 0) {

			} else {
				var result = valorSinDesimal * this.value;
				//agregar miles
				result = result.toString();
				resultado = result.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				document.getElementById('resultado_' + index).value = resultado;
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
			let valor_total_elems = document.querySelectorAll('.resultado');
			let valorSinDesimal = Array.from(valor_total_elems).map(function (elem) {
				return elem.value.replace(/,/g, '');
			});

			if (!document.getElementById('propina')) {
				let propina = 0;
				let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
				var total = suma + parseInt(propina);
				suma = suma.toString();
				total = total.toString();
				suma = suma.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				total = total.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				document.querySelector('#total_1').value = total;
				document.querySelector('#total').value = suma;
			} else {
				let propina = document.getElementById('propina').value;
				let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
				var total = suma + parseInt(propina);
				//agregar miles
				suma = suma.toString();
				total = total.toString();
				suma = suma.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				total = total.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				document.querySelector('#total_1').value = total;
				document.querySelector('#total').value = suma;
			}
		});
	});
});


//sumar factura propina
$(document).ready(function () {
	$(document).on('change', '.propina', function () {
		let propina = document.getElementById('propina').value
		let suma = document.getElementById('total').value
		var valorSinDesimalpropina = propina.replace(/,/g, '');
		var valorSinDesimalsuma = suma.replace(/,/g, '');
		//console.log(suma);
		//console.log(propina);
		var total = parseInt(valorSinDesimalsuma) + parseInt(valorSinDesimalpropina);
		//console.log(total);
		total = total.toString();
		total = total.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		document.querySelector('#total_1').value = total
	});
});

//calcular propina
$(document).ready(function () {
	let valor_total_elems = document.querySelectorAll('.resultado');
	let valorSinDesimal = Array.from(valor_total_elems).map(function (elem) {
		return elem.value.replace(/,/g, '');
	});
	let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
	//console.log(suma);
	promocion = suma * 0.10;
	promocion = promocion.toString();
	promocion = promocion.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	if (!document.querySelector('#propina')) {

	} else {

		document.querySelector('#propina').value = promocion
	}
});

//sumar factura auto con propina
$(document).ready(function () {
	if (document.getElementById('total_1')) {
		let valor_total_elems = document.querySelectorAll('.resultado');
		let valorSinDesimal = Array.from(valor_total_elems).map(function (elem) {
			return elem.value.replace(/,/g, '');
		});
		if (!document.getElementById('propina')) {
			let propina = 0
			let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
			//console.log(suma);
			//console.log(propina);
			var total = suma + parseInt(propina);
			total = total.toString();
			total = total.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
			document.querySelector('#total_1').value = total
		} else {
			let propina = document.getElementById('propina').value
			var valorSinDesimalPropina = propina.replace(/,/g, '');
			let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
			//console.log(suma);
			console.log(valorSinDesimalPropina);
			var total = suma + parseInt(valorSinDesimalPropina);
			total = total.toString();
			total = total.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
			document.querySelector('#total_1').value = total
		}
	}
});

//sumar factura auto
$(document).ready(function () {
	if (!document.getElementById('total')) {

	} else {
		let valor_total_elems = document.querySelectorAll('.resultado');
		let valorSinDesimal = Array.from(valor_total_elems).map(function (elem) {
			return elem.value.replace(/,/g, '');
		});
		let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
		//console.log(suma);
		//console.log(propina);
		suma = suma.toString();
		suma = suma.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		document.querySelector('#total').value = suma
	}
});

//cambio
$(document).ready(function () {
	$(document).on('change', '#pago_1', function () {

		var valorCampo = $('#total_1').val();
		var valorSinDesimalTotal = valorCampo.replace(/,/g, '');
		var pago = $('#pago_1').val();
		//console.log(pago);
		resta = parseInt(this.value) - valorSinDesimalTotal;
		resta = resta.toString();
		resta = resta.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		//console.log(resta)
		document.querySelector('#cambio_1').value = resta
		pago = pago.toString();
		pago = pago.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		$('#pago_1').val(pago);
	});

	$(document).on('change', '#pago_2', function () {

		var valorCampo = $('#cambio_1').val();
		var valorSinDesimalTotal = valorCampo.replace(/,/g, '');
		var pago = $('#pago_2').val();
		console.log(valorSinDesimalTotal);
		console.log(pago);
		resta = parseInt(this.value) - valorSinDesimalTotal;
		resta = resta.toString();
		resta = resta.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		//console.log(resta)
		document.querySelector('#cambio_2').value = resta
		pago = pago.toString();
		pago = pago.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		$('#pago_2').val(pago);
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
		} if (metodoPago === 'member') {
			$('#pago_1').val(0);
			document.querySelector('#cambio_1').value = 0
		} if (metodoPago === 'observacion') {
			var fields = document.getElementById('fields');
			if (metodoPago === 'observacion') {
				fields.classList.remove('hidden');
				$('#pago_1').prop('disabled', false);

				// Calcular el total y establecerlo como el monto a pagar
				var total = calcularTotal();
				//console.log(total);
				total = total.toString();
				total = total.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				$('#pago_1').val(total);
				var valorCampo = $('#total_1').val();
				var pago = $('#pago_1').val();
				var valorSinDesimalPago = pago.replace(/,/g, '');
				var valorSinDesimalTotal = total.replace(/,/g, '');
				//console.log(pago);
				resta = parseInt(valorSinDesimalPago) - valorSinDesimalTotal;
				//console.log(resta)
				resta = resta.toString();
				resta = resta.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				document.querySelector('#cambio_1').value = resta

				var nombre = document.getElementById('nombre');
				var plateNumber = document.getElementById('plateNumber');
				var observacion = document.getElementById('observacion');
				nombre.required = true;
				plateNumber.required = true;
				observacion.required = true;
			} else {
				fields.classList.add('hidden');
			}
		} else {
			// Si es cualquier otro método de pago
			// Inhabilitar el campo de monto a pagar
			$('#pago_1').prop('disabled', false);

			// Calcular el total y establecerlo como el monto a pagar
			var total = calcularTotal();
			//console.log(total);
			total = total.toString();
			total = total.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
			$('#pago_1').val(total);
			var valorCampo = $('#total_1').val();
			var pago = $('#pago_1').val();
			var valorSinDesimalPago = pago.replace(/,/g, '');
			var valorSinDesimalTotal = total.replace(/,/g, '');
			//console.log(pago);
			resta = parseInt(valorSinDesimalPago) - valorSinDesimalTotal;
			//console.log(resta)
			resta = resta.toString();
			resta = resta.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
			document.querySelector('#cambio_1').value = resta
		}
	});

	function calcularTotal() {
		// Recorrer todos los campos de resultado y sumar sus valores
		let valor_total_elems = document.querySelectorAll('.resultado');
		let valorSinDesimal = Array.from(valor_total_elems).map(function (elem) {
			return elem.value.replace(/,/g, '');
		});
		if (!document.getElementById('propina')) {
			let propina = 0
			let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
			var total = suma + parseInt(propina);
			//console.log(suma);
			return total;
		} else {
			let propina = document.getElementById('propina').value
			var valorSinDesimalPropina = propina.replace(/,/g, '');
			let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
			var total = suma + parseInt(valorSinDesimalPropina);
			//console.log(suma);
			return total;
		}
	}
});

//placa mayusculas
if (document.getElementById('plateNumber')) {
	document.getElementById('plateNumber').addEventListener('input', function () {
		this.value = this.value.toUpperCase();
	});
}

//Seleccion metodo de pago 2
$(document).ready(function () {
	// Cuando se cambia el método de pago
	$('#metodo2').on('change', function () {
		var metodoPago = $(this).val(); // Obtenemos el valor seleccionado del método de pago
		//console.log(metodoPago);
		// Si el método de pago es "efectivo"
		if (metodoPago === 'efectivo') {
			// Habilitar el campo de monto a pagar
			$('#pago_2').prop('disabled', false);
		} else {
			// Si es cualquier otro método de pago
			// Inhabilitar el campo de monto a pagar
			$('#pago_2').prop('disabled', false);

			// Calcular el total y establecerlo como el monto a pagar
			var total = calcularTotal();
			//console.log(total);
			total = total.toString();
			total = total.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
			$('#pago_2').val(total);
			var valorCampo = $('#total_1').val();
			var pago = $('#pago_2').val();
			var valorSinDesimalPago = pago.replace(/,/g, '');
			var valorSinDesimalTotal = total.replace(/,/g, '');
			//console.log(pago);
			resta = parseInt(valorSinDesimalPago) - valorSinDesimalTotal;
			//console.log(resta)
			resta = resta.toString();
			resta = resta.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
			document.querySelector('#cambio_2').value = resta
		}
	});

	function calcularTotal() {
		if (!document.getElementById('propina')) {
			let propina = 0
			let pago1 = document.getElementById('cambio_1').value
			var valorSinDesimalpago1 = pago1.replace(/,/g, '');
			var total = valorSinDesimalpago1
			//console.log(valorSinDesimalpago1);
			return total;
		} else {
			let pago1 = document.getElementById('cambio_1').value
			var valorSinDesimalpago1 = pago1.replace(/,/g, '');
			var total = valorSinDesimalpago1
			//console.log(suma);
			return total;
		}
	}
});

//agregar factura

$(document).ready(function () {
	var index = 2;
	$("#agregarFactura").click(function () {
		$("#factura").append('<tr class="eliminar_' + index + '"><td><input type="hidden" name="id_articulo[]" id="id_articulo_' + index + '"><input type="text" name="codigo" class="form-control codigo_articulo" id="codigo_' + index + '" placeholder="Codigo producto"></td><td><input type="text" name="articulo" class="form-control nombre_articulo" id="nombre_' + index + '" placeholder="Nombre producto"></td><td><input type="text" name="precio" class="form-control valor" id="valor_' + index + '" disabled></td><!--<td><input type="text" name="descuento[]" class="form-control" id="descuento_' + index + '" value="0"></td>--><!--<td><input type="text" name="peso[]" class="form-control peso" id="peso_' + index + '" value="0" required>--><td><input type="text" name="cantidad[]" class="form-control cantidad" id="cantidad_' + index + '" value="0" required></td><td><input type="text" name="total" class="form-control resultado" id="resultado_' + index + '" disabled></td><td><a class="btn btn-primary mt-3 eliminar" id="eliminarFactura">Eliminar</a></td></tr>');
		index++;
	});
});

//agregar material
$(document).ready(function () {
	var index = 2;
	$("#material").click(function () {
		$("#agregarMaterial").append('<tr><th><input type="text" name="materiales[]" class="form-control nombre_articulo" id="nombre_' + index + '"></th></tr>');
		index++;
	});
});
$(document).ready(function () {
	var index = 2;
	$("#materialEdit").click(function () {
		$("#agregarMaterialEdit").append('<tr><th><input type="text" name="materiales[]" class="form-control nombre_articulo" id="nombre_' + index + '"></th></tr>');
		index++;
	});
});
//revome
for (let index = 0; index < 30; index++) {

	$(document).on('click', '.eliminar', function () {
		let valor_total_elems = document.querySelectorAll('.resultado');
		let valorSinDesimal = Array.from(valor_total_elems).map(function (elem) {
			return elem.value.replace(/,/g, '');
		});
		let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
		suma = suma.toString();
		suma = suma.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		//console.log(suma);
		document.querySelector('#total_1').value = suma
		document.querySelector('#total').value = suma
		$(this).parents('.eliminar_' + index + '').remove();
		// Calcular el total y establecerlo como el monto a pagar
		var total = calcularTotal();
		//console.log(total);
		total = total.toString();
		total = total.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		$('#pago_1').val(total);
		var valorCampo = $('#total_1').val();
		var pago = $('#pago_1').val();
		var valorSinDesimalPago = pago.replace(/,/g, '');
		var valorSinDesimalTotal = total.replace(/,/g, '');
		//console.log(pago);
		resta = parseInt(valorSinDesimalPago) - valorSinDesimalTotal;
		//console.log(resta)
		resta = resta.toString();
		resta = resta.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		document.querySelector('#cambio_1').value = resta
		function calcularTotal() {
			// Recorrer todos los campos de resultado y sumar sus valores
			let valor_total_elems = document.querySelectorAll('.resultado');
			let valorSinDesimal = Array.from(valor_total_elems).map(function (elem) {
				return elem.value.replace(/,/g, '');
			});
			if (!document.getElementById('propina')) {
				let propina = 0
				let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
				var total = suma + parseInt(propina);
				//console.log(suma);
				return total;
			} else {
				let propina = document.getElementById('propina').value
				var valorSinDesimalPropina = propina.replace(/,/g, '');
				let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
				var total = suma + parseInt(valorSinDesimalPropina);
				//console.log(suma);
				return total;
			}
		}
		if (document.getElementById('total_1')) {
			let valor_total_elems = document.querySelectorAll('.resultado');
			let valorSinDesimal = Array.from(valor_total_elems).map(function (elem) {
				return elem.value.replace(/,/g, '');
			});
			if (!document.getElementById('propina')) {
				let propina = 0
				let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
				//console.log(suma);
				//console.log(propina);
				var total = suma + parseInt(propina);
				total = total.toString();
				total = total.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				document.querySelector('#total_1').value = total
			} else {
				let propina = document.getElementById('propina').value
				var valorSinDesimalPropina = propina.replace(/,/g, '');
				let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
				//console.log(suma);
				//console.log(propina);
				var total = suma + parseInt(valorSinDesimalPropina);
				total = total.toString();
				total = total.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				document.querySelector('#total_1').value = total
			}
		}
	})
}

//autocomplete numero cc

$('body').on('click', '#cc', function () {
	$(this).autocomplete({
		source: function (request, response) {
			$.ajax({
				url: 'views/ajax.php',
				type: 'get',
				dataType: 'json',
				data: { cc: request.term },
				success: function (data) {
					response(data);
					//console.log("el dato", data);

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


//codigo de barra factura
$(document).ready(function () {
	$(document).on('keydown', '.codigo_articulo', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		var controladorTiempo = "";
		var cantidad = 0;
		var posicion = [];
		var arrayQR = [];
		function codigoAJAX() {
			var codigo = $('#codigo_' + index + '').val();
			var numero = (cantidad + 1) == 0 ? 1 : cantidad + 1;
			//console.log(numero);
			inicio = 0;
			for (i = 0; i < numero; i++) {
				codigobarra = codigo.substring(inicio, posicion[i]);
				inicio = posicion[i];
				arrayQR.push(codigobarra);
				$.ajax({
					url: 'views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { codigo1: codigo },

				})
					.done(function (data) {
						console.log("el dato", data);
						var len = data.length;
						if (len > 0) {
							var id = data[0]['id_producto'];
							var codigo = data[0]['codigo_producto'];
							var name = data[0]['nombre_producto'];
							//agregar miles
							var valor = data[0]['precio_unitario'];
							valor = valor.toString();
							value = valor.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

							document.getElementById('id_articulo_' + index).value = id;
							document.getElementById('codigo_' + index).value = codigo;
							document.getElementById('nombre_' + index).value = name;
							document.getElementById('valor_' + index).value = value;
						}
					})

			}
			cantidad = 0;
			posicion = [];
			$('#codigo_' + index + '').val('');
		}
		$('#codigo_' + index + '').on("keyup", function (e) {
			var codigo = $('#codigo_' + index + '').val();
			largo = codigo.length;

			if (e.which == 13) {
				cantidad++;
				posicion.push(largo);
			}
			clearTimeout(controladorTiempo);
			controladorTiempo = setTimeout(codigoAJAX, 500);
		});
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
					url: 'views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { nombre: request.term },
					success: function (data) {
						response(data);
						//console.log("el dato", data);
					}

				});
			}, select: function (event, ui) {
				$(this).val(ui.item.labelN); // display the selected text
				var userid = ui.item.value; // selected id to input

				// AJAX
				$.ajax({
					url: 'views/ajax.php',
					type: 'get',
					data: { userid: userid, request: 2 },
					dataType: 'json',
					success: function (data) {

						var len = data.length;
						if (len > 0) {
							var id = data[0]['id_producto'];
							var codigo = data[0]['codigo_producto'];
							var name = data[0]['nombre_producto'];
							var cantidad = data[0]['cantidad_producto'];
							//agregar miles
							var valor = data[0]['precio_unitario'];
							valor = valor.toString();
							value = valor.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
							var urlActual = window.location.href;
							var hosting = window.location.hostname;
							//console.log(hosting);
							//if (cantidad <= 0) {
							//swal("Ups!!!!", "El producto: "+name+" esta agotado", "error");
							//} else {
							if (urlActual == "http://" + hosting + "/juniorPizza/caja") {
								document.getElementById('id_articulo_' + index).value = id;
								document.getElementById('codigo_' + index).value = codigo;
								document.getElementById('nombre_' + index).value = name;
								document.getElementById('valor_' + index).value = value;
							} else {
								document.getElementById('nombre_' + index).value = name;
							}
							//}
						}

					}
				});

				return false;
			}
		});
	});
});

//Autocomplete Ingrediente Editar
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
				$("#id_medida_" + index).val(ui.item.id_medida);
				$("#medida_" + index).val(ui.item.medida);
				$("#cantidad_" + index).val(ui.item.cantidad);
				$("#id_local_" + index).val(ui.item.id_local);
				$("#local_" + index).val(ui.item.local);
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
		if (urlActual == "http://" + hosting + "/juniorPizza/productos") {
			if (!document.getElementById('agregarProducto')) {
				document.getElementById("agreProducto").click();
			} else {
				document.getElementById("agregarProducto").click();
			}
		} if (urlActual == "http://" + hosting + "/juniorPizza/ingredientes") {
			if (!document.getElementById("agregarIngrediente")) {
				document.getElementById("agregIngrediente").click();
			} else {
				document.getElementById("agregarIngrediente").click();
			}
		} if (urlActual == "http://" + hosting + "/juniorPizza/ingrediente_Producto") {
			if (document.getElementById("agregarIngredienteProducto")) {
				document.getElementById("agregarIngredienteProducto").click();
			}
		} if (urlActual == "http://" + hosting + "/juniorPizza/promocion") {
			if (document.getElementById("agregarPromocion")) {
				document.getElementById("agregarPromocion").click();
			}
		} else {
			if (document.getElementById("agregarFactura")) {
				document.getElementById("agregarFactura").click();
			}
		}

	}
	//eliminar columna factura
	if (event.key === 'F4') {
		document.getElementById("eliminarFactura").click();
	}
});

//calcular dias trabajado
$(document).ready(function () {
	$(document).on('change', '#pago', function () {

		var valorCampo = $('#dia').val();
		console.log(valorCampo);
		resta = parseInt(this.value) * valorCampo;
		//console.log(resta)
		document.querySelector('#pago_dia').value = resta
	});
});
//abono deuda
$(document).ready(function () {
	$(document).on('keydown', '#abono', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		let cantidad = document.getElementById('abono');
		cantidad.addEventListener("keyup", function () {
			let valor_total_elems = document.querySelectorAll('#deuda')
			let abono = document.getElementById('abono').value
			var valorSinDesimalabono = abono.replace(/,/g, '');
			let suma = 0
			valor_total_elems.forEach(e => suma -= parseInt(e.value))
			let resta = 0
			resta = suma - valorSinDesimalabono;
			resta = resta.toString();
			resta = resta.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
			document.querySelector('#Total').value = resta
		});
	});
});


$(document).ready(function () {
	$(document).on('keydown', '.precio', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		let cantidad = document.getElementById('precio_' + index + '');
		cantidad.addEventListener("keyup", function () {
			// Eliminar caracteres no numéricos
			let value = cantidad.value.replace(/\D/g, '');

			// Añadir coma para separar miles
			value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

			// Agregar el símbolo de la moneda o unidad
			value = value; // Puedes cambiar 'kg' por el símbolo que desees

			// Establecer el valor formateado en el campo de entrada
			cantidad.value = value;
		});
	});
	$(document).on('keydown', '.precio_uni', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		let cantidad = document.getElementById('precioUni_' + index + '');
		cantidad.addEventListener("keyup", function () {
			// Eliminar caracteres no numéricos
			let value = cantidad.value.replace(/\D/g, '');

			// Añadir coma para separar miles
			value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

			// Agregar el símbolo de la moneda o unidad
			value = value; // Puedes cambiar 'kg' por el símbolo que desees

			// Establecer el valor formateado en el campo de entrada
			cantidad.value = value;
		});
	});
});
//peso propina
$(document).ready(function () {
	$(document).on('keydown', '.propina', function () {

		let cantidad = document.getElementById('propina');
		cantidad.addEventListener("keyup", function () {
			// Eliminar caracteres no numéricos
			let value = cantidad.value.replace(/\D/g, '');

			// Añadir coma para separar miles
			value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

			// Agregar el símbolo de la moneda o unidad
			value = value; // Puedes cambiar 'kg' por el símbolo que desees

			// Establecer el valor formateado en el campo de entrada
			cantidad.value = value;
		});
	});

	$(document).on('keydown', '.monto', function () {

		let cantidad = document.getElementById('monto');
		cantidad.addEventListener("keyup", function () {
			// Eliminar caracteres no numéricos
			let value = cantidad.value.replace(/\D/g, '');

			// Añadir coma para separar miles
			value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

			// Agregar el símbolo de la moneda o unidad
			value = value; // Puedes cambiar 'kg' por el símbolo que desees

			// Establecer el valor formateado en el campo de entrada
			cantidad.value = value;
		});
	});

	$(document).on('keydown', '.abono', function () {

		let cantidad = document.getElementById('abono');
		cantidad.addEventListener("keyup", function () {
			// Eliminar caracteres no numéricos
			let value = cantidad.value.replace(/\D/g, '');

			// Añadir coma para separar miles
			value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

			// Agregar el símbolo de la moneda o unidad
			value = value; // Puedes cambiar 'kg' por el símbolo que desees

			// Establecer el valor formateado en el campo de entrada
			cantidad.value = value;
		});
	});

	$(document).on('keydown', '.totalFactura', function () {

		let cantidad = document.getElementById('totalFactura');
		cantidad.addEventListener("keyup", function () {
			// Eliminar caracteres no numéricos
			let value = cantidad.value.replace(/\D/g, '');

			// Añadir coma para separar miles
			value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

			// Agregar el símbolo de la moneda o unidad
			value = value; // Puedes cambiar 'kg' por el símbolo que desees

			// Establecer el valor formateado en el campo de entrada
			cantidad.value = value;
		});
	});
});
//gastos precio unitario * cantidad
$(document).ready(function () {
	$(document).on('change', '.cant', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		var cantidad = parseFloat(document.getElementById('cant_' + index).value);
		var precioUnitario = parseFloat(document.getElementById('precioUni_' + index).value.replace(/,/g, ''));

		// Dividir el precio unitario por la cantidad para obtener el precio por unidad
		var precioPorUnidad = precioUnitario / cantidad;
		//console.log(precioPorUnidad);
		// Calcular el total por cada elemento
		var totalPorElemento = precioPorUnidad * cantidad;
		//console.log(totalPorElemento);
		// Obtener el campo de total de factura
		var totalFacturaInput = document.getElementById('totalFactura');
		var totalInput = document.getElementById('total_' + index);
		//console.log(totalFacturaInput);
		// Convertir el valor actual del total de factura a número
		var totalFactura = parseFloat(totalFacturaInput.value.replace(/,/g, ''));
		var total = parseFloat(totalInput.value.replace(/,/g, ''));
		// Sumar el total por elemento al total de factura
		totalFactura += totalPorElemento;
		let valor_total_elems = document.querySelectorAll('.precio_uni');
		let valorSinDesimal = Array.from(valor_total_elems).map(function (elem) {
			return elem.value.replace(/,/g, '');
		});
		let suma = valorSinDesimal.reduce((acc, curr) => acc + parseInt(curr), 0);
		//console.log(totalFactura);
		// Formatear el total de factura con comas
		var totalFacturaFormateado = suma.toLocaleString('en-US');
		var totalFormateado = precioPorUnidad.toLocaleString('en-US');
		//console.log(totalFacturaFormateado);
		// Actualizar el campo de total de factura con el nuevo total formateado
		totalFacturaInput.value = totalFacturaFormateado;
		totalInput.value = totalFormateado;
	});
});

//agregar factura devolucion

$(document).ready(function () {
	$('body').on('keydown', '.factura', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];
		console.log();
		$(this).autocomplete({
			source: function (request, response) {
				$.ajax({
					url: 'views/ajax.php',
					type: 'get',
					dataType: 'json',
					data: { factura: request.term },
					success: function (data) {
						response(data);
						//console.log("el dato", data);

					}

				});
			},
			minLength: 1,
			select: function (event, ui) {
				$("#producto_" + index).val(ui.item.label);
				$("#codigoProducto_" + index).val(ui.item.label1);
				$("#cant").val(ui.item.label2);
				$("#cantidad_" + index).val(ui.item.label2);
				$("#precio_" + index).val(ui.item.precio);
				$("#total_" + index).val(ui.item.total);
				$("#id").val(ui.item.id);
				$("#efectivo").val(ui.item.efectivo);
				$("#factura").val(ui.item.id_factura);
				return false;

			}

		});
	});
});


$(document).ready(function () {
	$('.miTabla').on('click', function () {
		var $td = $(this);
		var valorActual = $td.text().replace(",", ""); // Eliminar comas
		var $input = $('<input type="text" class="form-control propina" id="propina">').val(valorActual);

		$td.empty().append($input);
		$input.focus();
		var factura = $('#num_factura').text(); // Usar jQuery para seleccionar el elemento

		$input.blur(function () {
			var nuevoValor = $(this).val();
			var sindecimal = nuevoValor.replace(",", "");
			// Formatear el valor con comas cuando el campo pierde el foco
			$td.text(nuevoValor.toLocaleString('es'));

			// Hacer la llamada AJAX solo con los números enteros (sin comas)
			$.ajax({
				url: 'views/ajax.php',
				method: 'GET',
				data: { nuevo_valor: sindecimal, id_factura: factura },
				success: function (response) {
					// Manejar la respuesta del servidor si es necesario
					location.reload();
				},
				error: function (xhr, status, error) {
					// Manejar errores si es necesario
				}
			});

			// Al hacer clic fuera del input, actualizar el valor de miTabla con el valor del input
			$td.text(nuevoValor);
		});
	});
});

var currentURL = window.location.href;
var host = window.location.hostname;
if (currentURL.includes("http://" + host + "/juniorPizza/caja")) {

	document.addEventListener("DOMContentLoaded", async () => {
		// Función para calcular el total de una fila
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
				const nombreImpresora = "prueba1";
				if (!nombreImpresora) {
					return alert("Por favor seleccione una impresora. Si no hay ninguna, asegúrese de haberla compartido como se indica en: https://parzibyte.me/blog/2017/12/11/instalar-impresora-termica-generica/")
				}
				imprimirTabla("prueba1");
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

			function calcularTotal(fila) {
				var precio = fila.find('.resultado').val();
				var total = precio
				return total;
			}

			// Función para obtener los campos nombre, cantidad y total de la factura
			function obtenerCamposFactura() {
				var camposFactura = [];
				$('#factura tr').each(function () {
					var fila = $(this);
					var nombre = fila.find('.nombre_articulo').val();
					var cantidad = fila.find('.cantidad').val();
					var precio = fila.find('.valor').val();
					var total = calcularTotal(fila);
					camposFactura.push({
						nombre: nombre,
						cantidad: cantidad,
						precio: precio,
						precioTotal: total
					});
				});
				return camposFactura;
			}

			// Ejemplo de uso
			var factura = obtenerCamposFactura();
			console.log(factura);
			var nom_proeevedor = document.getElementById('nom_proeevedor').textContent;
			var nit_proeevedor = document.getElementById('nit_proeevedor').textContent;
			var tel_proeevedor = document.getElementById('tel_proeevedor').textContent;
			var dir_proeevedor = document.getElementById('dir_proeevedor').textContent;
			if (document.getElementById('propina')) {
				var propina = document.getElementById('propina').value
			} else {
				var propina = 0
			}
			if (document.getElementById('total')) {
				var total = document.getElementById('total').value
			} else {
				var total = 0
			}
			var total_1 = document.getElementById('total_1').value
			const listaDeProductos = factura;
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
				.EscribirTexto(nom_proeevedor + "\n")
				.TextoSegunPaginaDeCodigos(2, "cp850", "Nit: " + nit_proeevedor + "\n")
				.TextoSegunPaginaDeCodigos(2, "cp850", "Teléfono: " + tel_proeevedor + ">\n")
				.TextoSegunPaginaDeCodigos(2, "cp850", "Direccion: " + dir_proeevedor + "\n")
				.EscribirTexto("Fecha: " + (new Intl.DateTimeFormat("es-MX").format(new Date())))
				.Feed(1)
				.EstablecerAlineacion(ConectorPluginV3.ALINEACION_IZQUIERDA)
				.EscribirTexto("____________________\n")
				.EstablecerAlineacion(ConectorPluginV3.ALINEACION_DERECHA)
				.EscribirTexto(tabla)
				.EscribirTexto("------------------------------------------------\n")
				.EscribirTexto("SubTotal $" + total + "\n")
				.EscribirTexto("Propina $" + propina + "\n")
				.EscribirTexto("Total $" + total_1 + "\n")
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

}

/*const totalInput = document.getElementById('total_1');
const pago1Input = document.getElementById('pago_1');
const pago2Input = document.getElementById('pago_2');
const metodo1Select = document.getElementById('metodo');
const metodo2Select = document.getElementById('metodo2');


pago1Input.addEventListener('change', function() {
	const total = totalInput.value;
	const pago1 = pago1Input.value;
    
	if (pago1 < total) {
	    
		metodo2Select.disabled = false;
		//console.log("Segundo método de pago activado.");
	} else {
	    
		metodo2Select.disabled = true;
		pago2Input.disabled = true;
		//console.log("Facturación normal.");
	}
});*/

//suma factura valor * porciento
$(document).ready(function () {
	$(document).on('keydown', '.porciento', function () {
		var id = this.id;
		var splitid = id.split('_');
		var index = splitid[1];

		var valor_descuento = 0/*document.getElementById('descuento_' + index + '').value*/;
		var valor = document.getElementById('valor_' + index + '').value;
		//eliminar miles
		var valorSinDesimal = valor.replace(/,/g, '');
		let cantidad = document.getElementById('porciento_' + index + '');
		cantidad.addEventListener("keyup", function () {
			if (valor_descuento > 0) {

			} else {
				var procentaje = (valorSinDesimal * this.value) / 100;
				//console.log(procentaje);
				var result = parseFloat(valorSinDesimal) + parseFloat(procentaje);
				//agregar miles
				result = result.toString();
				resultado = result.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				document.getElementById('resultado_' + index).value = resultado;
				let valor_total_elems = document.querySelectorAll('#resultado_' + index + '')
				let valor = Array.from(valor_total_elems).map(function (elem) {
					return elem.value.replace(/,/g, '');
				});
				let suma = valor.reduce((acc, curr) => acc + parseInt(curr), 0);
				suma = suma.toString();
				suma = suma.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
				document.querySelector('#total_1').value = suma;
			}
		});
	});
});
//Cargar EXCEL
$(document).ready(function () {
	$('#uploadForm').on('submit', function (e) {
		e.preventDefault(); // Prevenir la recarga de la página

		// Crear un FormData para enviar el archivo
		var formData = new FormData(this);

		// Obtener el valor del id_local desde el campo input hidden
		var id_local = $('#id_local').val();

		// Agregar el id_local al FormData
		formData.append('id_local', id_local);

		$.ajax({
			url: 'views/excel.php', // Archivo PHP para procesar el cargue
			type: 'POST',
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
				alert(response); // Mostrar respuesta del servidor
				$('#cargarModal').modal('hide'); // Cerrar el modal
				location.reload();
			},
			error: function () {
				alert('Error al cargar el archivo.');
			}
		});
	});
});