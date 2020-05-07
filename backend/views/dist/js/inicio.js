


	$("#formu-editar-inicio").submit(function (e) {
		e.preventDefault()

		var datos = new FormData($(this)[0])

		$.ajax({
			url: 'ajax/ajaxInicio.php',
			type: 'POST',
			data: datos,
			processData: false,
			contentType: false,
			success: function(respuesta) {
				console.log(respuesta)
				if (respuesta == "ok") {
					swal({
					  type: 'success',
					  title: 'Actualizado',
					  text: 'Información actualizada con éxito'
					}).then((result) => {
					  if (result.value) {
					    window.location = "inicio"
					  }
					})
				}
			}

		})

	})



	$("body .table-dark").on("click", ".btnEditarInicio", function(){
		var idInicio = $(this).attr("idInicio")
		var datos = new FormData()

		datos.append("id_Inicio", idInicio)
		datos.append("tipoOperacion", "editarInicio")
	console.log(datos)
		$.ajax({
			url: 'ajax/ajaxInicio.php',
			type: 'POST',
			data: datos,
			processData: false,
			contentType: false,
			success: function(respuesta) {
				var valor = JSON.parse(respuesta)
				console.log(valor.informacion)

				$('#formu-editar-inicio textarea[name="descripcionInicio"]').val(valor.informacion)
					$('#formu-editar-inicio input[name="id_Inicio"]').val(valor.id_info)




			}

		})

	})








