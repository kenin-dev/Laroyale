const b_edit = document.getElementById('b-editar')
var nombresArray = new Array()
var abrevArray   = new Array()

document.addEventListener('DOMContentLoaded', function(e){

	b_edit.disabled = false
	cargarCategoria()
	
	document.addEventListener('submit', function(e){
		if (e.target.matches('#form-registro')) {	

			let arch = document.getElementById('inputImagen')
			let peso = (parseFloat(arch.files[0].size)/1000).toFixed(2)

			if (peso > 2048) {
				e.preventDefault()
				not.error('Error','La imagen debe pesar menos de 2MB','topCenter')
			}
		}
	}, false)

}, true)	
function cargarCategoria(){
	fetch(srv.url()+'categoria/consulta_rest')
	.then(function(resp){
		return resp.json()
	})
	.then(function(resp){
		// console.log(resp)
		for(let i=0;i<resp.length;i++){
			nombresArray.push(resp[i].cat_nombre)
			abrevArray.push(resp[i].cat_abreviatura)

		}
	})
	.catch(function(err){
		console.log(err.message)
	})
}