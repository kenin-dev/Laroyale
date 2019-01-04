const breg = document.getElementById('b-registrar')
var nombresArray = new Array()
var abrevArray   = new Array()
var categoriaArray   = new Array()

document.addEventListener('DOMContentLoaded', function(e){

	breg.disabled = false
	cargarProducto()
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

var validarProducto = function(p,c){
	if( nombresArray.includes(p.toUpperCase()) && categoriaArray.includes(c) ) {
		return true
	}else{
		return false
	}
}	
function cargarProducto(){
	fetch(srv.url()+'producto/consulta_rest')
	.then(function(resp){
		return resp.json()
	})
	.then(function(resp){
		// console.log(resp)
		for(let i=0;i<resp.length;i++){
			nombresArray.push(resp[i].prod_nombre)
			abrevArray.push(resp[i].prod_abreviatura)
			categoriaArray.push(resp[i].prod_categoria)
		}
	})
	.catch(function(err){
		console.log(err.message)
	})
}