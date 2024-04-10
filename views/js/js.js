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
				$("#id_prodcu" + index).val(ui.item.id);
				$("#codigoProd_" + index).val(ui.item.codigo);
				return false;

			}

		});
	});
});

//Agreagr Producto

$(document).ready(function () {
	var index = 2;
	$("#agregarProducto").click(function () {
		$("#producto").append('<tr><td><input type="text" class="form-control" name="codigo[]"></td><td><input type="text" class="form-control" name="nombre[]"></td><td><input type="text" class="form-control" name="precio[]"></td><td><input type="text" class="form-control" name="cantidad[]"></td><td><input type="hidden" class="form-control" name="id_categoria[]"id="id_categoria_'+index+'"><input type="text" class="form-control categoria"name="" id="categoria_'+index+'"></td><td><input type="hidden" class="form-control" name="id_medida[]"id="id_medida_'+index+'"><input type="text" class="form-control medida" name=""id="medida_'+index+'"></td><?php if ($_SESSION["rol"] == "Administrador") { ?><td><input type="hidden" class="form-control " name="id_local[]"id="id_local_'+index+'"><input type="text" class="form-control nom_local" id="local_'+index+'"></td><?php } ?></tr>');
		index++;
	});
});

//Agreagr ingrediente

$(document).ready(function () {
	var index = 2;
	$("#agregarIngrediente").click(function () {
		$("#ingrediente").append('<tr><td><input type="text" class="form-control" name="nom_ingre[]"></td><td><input type="text" class="form-control" name="cant[]"></td><td><input type="hidden" class="form-control" name="id_medida[]"id="id_medida_'+index+'"><input type="text" class="form-control medida" name=""id="medida_'+index+'"></td></tr>');
		index++;
	});
});

//Agreagr ingrediente&procuto

$(document).ready(function () {
	var index = 2;
	$("#agregarIngredienteProducto").click(function () {
		$("#ingreprodu").append('<tr><td><input type="hidden" name="id_ingre[]" id="id_ingre_'+index+'"><input type="text"class="form-control ingre" id="ingre_'+index+'"></td><td><input type="text" class="form-control" id="medida_'+index+'"></td><td><input type="text" class="form-control" name="cantidad[]"></td></tr>');
		index++;
	});
});

//Agreagr promocion&procuto

$(document).ready(function () {
	var index = 2;
	$("#agregarPromocion").click(function () {
		$("#produc").append('<tr><td><input type="hidden" name="id_prodcu[]" id="id_prodcu_'+index+'"><input type="text"class="form-control prod" id="produc_'+index+'"></td><td><input type="text" name="" id="codigoProd_'index'" class="form-control"></td><td><input type="text" id="" name="cantidadPromocion[]" class="form-control"></td></tr>');
		index++;
	});
});

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


