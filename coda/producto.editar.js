const b_edit = document.getElementById('b-editar')


document.addEventListener('DOMContentLoaded', function(e){

	b_edit.disabled = false
	// cargarProducto()
	// console.log(nombresArray)
	// console.log(categoriaArray)
	
	document.addEventListener('submit', function(e){
		if (e.target.matches('#form-registro')) {	
			

			let nom = document.querySelector('[name=inputNombre]').value
			let abrev = document.querySelector('[name=inputAbreviatura]').value
			let cate = document.querySelector('[name=inputCategoria]').value
			if (validarProducto(nom,cate) == true) {
				e.preventDefault()
				not.aviso('Cuidado','Ya existe un producto con esos datos','topCenter')
			}

		}
	}, false)

}, true)