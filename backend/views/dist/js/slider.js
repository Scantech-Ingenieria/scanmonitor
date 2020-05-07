

$(document).ready(function(){


	$("#formu-nuevo-slider").submit(function (e) {
		e.preventDefault()

		var datos = new FormData($(this)[0])

		$.ajax({
			url: 'ajax/ajaxSlider.php',
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
					  text: 'Slider creado con éxito'
					}).then((result) => {
					  if (result.value) {
					    window.location = "slider"
					  }
					})
				}
			}

		})

	})


	$("#formu-editar-slider").submit(function (e) {
		e.preventDefault()

		var datos = new FormData($(this)[0])

		$.ajax({
			url: 'ajax/ajaxSlider.php',
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
					  text: 'Slider actualizado con éxito'
					}).then((result) => {
					  if (result.value) {
					    window.location = "slider"
					  }
					})
				}
			}

		})

	})



	$("body .table-dark").on("click", ".btnEditarSlider", function(){
		var idSlider = $(this).attr("idSlider")
		var datos = new FormData()
		datos.append("id_slider", idSlider)
		datos.append("tipoOperacion", "editarSlider")

		$.ajax({
			url: 'ajax/ajaxSlider.php',
			type: 'POST',
			data: datos,
			processData: false,
			contentType: false,
			success: function(respuesta) {
				var valor = JSON.parse(respuesta)
				console.log(valor.id_slider)
				console.log(valor.titulo_slider)

				$('#formu-editar-slider #imagenSlider').attr("src", valor.imagen)
				$('#formu-editar-slider input[name="id_slider"]').val(valor.id_slider)
				$('#formu-editar-slider input[name="rutaActual"]').val(valor.imagen)

			}

		})

	})

	$("body #mi_lista").on("click", ".btnEliminarSlider", function(){
		var idSlider = $(this).attr("idSlider")
		var rutaImagen = $(this).attr("rutaImagen")
		var datos = new FormData()
		datos.append("id_slider", idSlider)
		datos.append("tipoOperacion", "eliminarSlider")
		datos.append("rutaImagen", rutaImagen)

		console.log(idSlider)


		swal({
		  title: '¿Estás seguro de eliminar?',
		  text: "Los cambios no son reversibles!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Si, Elimina!'
		}).then((result) => {
		  if (result.value) {
		  	$.ajax({
				url: 'ajax/ajaxSlider.php',
				type: 'POST',
				data: datos,
				processData: false,
				contentType: false,
				success: function(respuesta) {
					if ( respuesta == "ok") {
						swal(
					      'Eliminado!',
					      'Su archivo a sido eliminado.',
					      'success'
					    ).then((result) => {
						  if (result.value) {
						    window.location = "slider"
						  }
						})
					}
				}

			})
		  }
		})






	})


	// PREVISUALIZAR IMAGENES

	$("#imagen").change(previsualizarImg)
	$("#imagenEditar").change(previsualizarImg)


	function previsualizarImg(e) {
		var contenedor = e.target.parentNode

		var identificador = contenedor.classList[1]

		imgSlider = this.files[0];



		if ( imgSlider["type"] != "image/jpeg" && imgSlider["type"] != "image/png" && imgSlider["type"] != "video/mp4") {
				$("#imagen").val("")

				swal({
					type:'error',
					title: 'No es un archivo valido',
					text: 'Debe subir archivos formato JPEG , PNG , MP4',
			

				})
			}





		if ( imgSlider["type"] > 100000000000) {
				$("#imagenSlider").val("")

				swal({
					type: "Error al subir la imagen",
					text: "La imagen debe pesar MAX 2MB",
					icon: 'error',
					confirmButtonText: "¡Cerrar!",
				})
			}

			else {
				$("#imagenSlider").css("display", "block")

				var datosImagen = new FileReader;
		  		datosImagen.readAsDataURL(imgSlider);

		  		$(datosImagen).on("load", function(event){

		  			var rutaImagen = event.target.result;

		  			$("." + identificador +" #imagenSlider").attr("src", rutaImagen);
		  		})
			}

		}



})