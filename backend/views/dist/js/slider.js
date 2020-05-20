

$(document).ready(function(){


	$("#form_subir").submit(function (e) {
		e.preventDefault()

		var datos = new FormData($(this)[0])

		$.ajax({
			url: 'ajax/ajaxSlider.php',
			type: 'POST',
			data: datos,
			processData: false,
			contentType: false,
			   beforeSend: function(){
             $('body').addClass('loading'); //Agregamos la clase loading al body
        }
    }).done(function(respuesta) {
    	   $('body').removeClass('loading'); //Removemos la clase loading
				console.log(respuesta)
				if (respuesta == "ok") {
					swal({
					  type: 'success',
					  title: 'Excelente',
					  text: 'Se cargo archivo con éxito'
					}).then((result) => {
					  if (result.value) {
					    window.location = "slider"
					  }
					})
				}
			})

		})

	

	$("#form_pesaje").submit(function (e) {
		e.preventDefault()

		var datos = new FormData($(this)[0])

		$.ajax({
			url: 'ajax/ajaxSlider.php',
			type: 'POST',
			data: datos,
			processData: false,
			contentType: false,
		beforeSend: function(){
             $('body').addClass('loading'); //Agregamos la clase loading al body
        }
        	}).done(function(respuesta) {
    	   $('body').removeClass('loading'); //Removemos la clase loading

				console.log(respuesta)
				if (respuesta == "ok") {
					swal({
					  type: 'success',
					  title: 'Excelente',
					  text: 'Datos Guardados'
					}).then((result) => {
					  if (result.value) {
					    window.location = "slider"
					  }
					})
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
				beforeSend: function(){
             $('body').addClass('loading'); //Agregamos la clase loading al body
        }
    }).done(function(respuesta) {
    	   $('body').removeClass('loading'); //Removemos la clase loading

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
			})

		

	})



	$("body .listatotal").on("click", ".btnEditarSlider", function(){
		var idSlider = $(this).attr("idslider")
		console.log(idSlider)


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
		
				$('#formu-editar-slider input[name="id_slider"]').val(valor.id_slider)
				$('#formu-editar-slider input[name="segundos"]').val(valor.tiempo)
				$('#formu-editar-slider input[name="titulo"]').val(valor.titulo)
				$('#formu-editar-slider input[name="extension"]').val(valor.extension)
if(valor.extension=='video'){
				$('#formu-editar-slider #tiempoextension').css("display", "none")
}else{
				$('#formu-editar-slider #tiempoextension').css("display", "block")

}


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
							beforeSend: function(){
             $('body').addClass('loading'); //Agregamos la clase loading al body
        }
    }).done(function(respuesta) {
    	   $('body').removeClass('loading'); //Removemos la clase loading

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
		if ( imgSlider["type"] != "image/jpeg" && imgSlider["type"] != "image/png") {
				$("#imagen").val("")

				swal({
					type:'error',
					title: 'No es un archivo valido',
					text: 'Debe subir archivos formato JPEG , PNG ',
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


		$("#videos").change(previsualizarVideo)		
	function previsualizarVideo(e) {
		var contenedor = e.target.parentNode
		var identificador = contenedor.classList[1]
		imgSlider = this.files[0];
		if ( imgSlider["type"] != "video/mp4" ) {
				$("#videos").val("")

				swal({
					type:'error',
					title: 'No es un archivo valido',
					text: 'Debe subir archivos formato MP4',
				})
			}
		
			else {
				$("#videoslider").css("display", "block")
				var datosImagen = new FileReader;
		  		datosImagen.readAsDataURL(imgSlider);
		  		$(datosImagen).on("load", function(event){
		  			var rutaImagen = event.target.result;
		  			$("." + identificador +" #videoslider").attr("src", rutaImagen);
		  		})
			}
		}
})

document.addEventListener("DOMContentLoaded",()=>{
	let form = document.getElementById('form_subir');
	form.addEventListener("submit",function(event){
		event.preventDefault();
		subir_archivos(this);
	})
});
function subir_archivos(form){
	let barra_estado = form.children[6].children[0],
	span = barra_estado.children[0],
	boton_cancelar = form.children[7].children[1];
	barra_estado.classList.remove('barra_verde','barra_roja');
	//peticion
	let peticion = new XMLHttpRequest();
	//progreso
	peticion.upload.addEventListener("progress",(event)=>{
  let porcentaje = Math.round((event.loaded / event.total)*100)
  console.log(porcentaje);
  barra_estado.style.width = porcentaje+'%';
  span.innerHTML = porcentaje+'%';

	})
	//finalizado
	peticion.addEventListener("load",() =>{
		barra_estado.classList.add('barra_verde');
		span.innerHTML = "Proceso Completado";
	
	});
	peticion.open('post','subir.php');
	peticion.send(new FormData(form));
//cancelar
boton_cancelar.addEventListener("click",()=>{
	peticion.abort();
	barra_estado.classList.remove('barra_verde');
	barra_estado.classList.add('barra_roja');
	span.innerHTML = "Proceso Cancelado";


})
}