$('#btnCategorias').on('click', function(e){
	e.preventDefault()

	$("#capa").css('opacity', '1')
	$("#capa").fadeIn()

	$("#categorias").slideDown('fast')
})

$("#capa").on('click', function() {
	$("#capa").fadeOut()
	$("#categorias").slideUp('fast')	
})