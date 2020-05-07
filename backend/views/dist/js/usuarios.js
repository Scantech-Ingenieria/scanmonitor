$(document).ready(function(){


	$("#formu-nuevo-usuarios").submit(function (e) {
		e.preventDefault()

		var datos = new FormData($(this)[0])

		$.ajax({
			url: 'ajax/ajaxUsuario.php',
			type: 'POST',
			data: datos,
			processData: false,
			contentType: false,
			success: function(respuesta) {
				console.log(respuesta)
				if (respuesta == "ok") {
					swal({
					  type: 'success',
					  title: 'Excelente',
					  text: 'Usuario creado con éxito'
					}).then((result) => {
					  if (result.value) {
					    window.location = "usuarios"
					  }
					})
				}
			}

		})

	})


	$("#formu-editar-Usuarios").submit(function (e) {
		e.preventDefault()

		var datos = new FormData($(this)[0])

		$.ajax({
			url: 'ajax/ajaxUsuario.php',
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
					  text: 'Usuarios actualizado con éxito'
					}).then((result) => {
					  if (result.value) {
					    window.location = "usuarios"
					  }
					})
				}
			}

		})

	})



	$("body .table-dark").on("click", ".btnEditarUsuarios", function(){
		var idUsuarios = $(this).attr("idUsuarios")
		var datos = new FormData()
		datos.append("id_Usuarios", idUsuarios)
		datos.append("tipoOperacion", "editarUsuarios")

		$.ajax({
			url: 'ajax/ajaxUsuario.php',
			type: 'POST',
			data: datos,
			processData: false,
			contentType: false,
			success: function(respuesta) {
				var valor = JSON.parse(respuesta)
				console.log(valor.id_admin)
				console.log(valor.nombre_usuarios)

				$('#formu-editar-Usuarios input[name="id_Usuarios"]').val(valor.id_admin)
				$('#formu-editar-Usuarios input[name="urlUsuarios"]').val(valor.password)
				$('#formu-editar-Usuarios input[name="correo"]').val(valor.correo_admin)


				$('#formu-editar-Usuarios input[name="tituloUsuarios"]').val(valor.nombre_usuarios)
				$('#formu-editar-Usuarios #imagenUsuarios').attr("src", valor.imagen)
					$('#formu-editar-Usuarios input[name="rutaActual"]').val(valor.imagen)


			}

		})

	})

	$("body .table-dark").on("click", ".btnEliminarUsuarios", function(){
		var idUsuarios = $(this).attr("idUsuarios")
		var rutaImagen = $(this).attr("rutaImagen")
		console.log(rutaImagen);
		console.log("ruta Imagen")
		var datos = new FormData()
		datos.append("id_Usuarios", idUsuarios);
		datos.append("tipoOperacion", "eliminarUsuarios");
		datos.append("rutaImagen", rutaImagen);
		swal({
		  title: '¿Estás seguro de eliminars?',
		  text: "Los cambios no son reversibles!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Eliminsa!'
		}).then((result) => {
		  if (result.value) {
		  	$.ajax({
				url: 'ajax/ajaxUsuario.php',
				type: 'POST',
				data: datos,
				processData: false,
				contentType: false,
				success: function(respuesta) {
					console.log(respuesta)
					if ( respuesta == "ok") {
						swal(
					      'Eliminado!',
					      'Su archivo a sido eliminadso.',
					      'success'
					    ).then((result) => {
						  if (result.value) {
						    window.location = "usuarios"
						  }
						})
					}
				}

			})
		  }
		})






	})


	// PREVISUALIZAR IMAGENES




})