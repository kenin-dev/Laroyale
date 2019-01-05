var categoriaArray = new Array()
var productoArray  = new Array()

const catalogo_cont = document.getElementById('catalogo')

document.addEventListener('DOMContentLoaded', function(){

	cargarCategorias()

	document.addEventListener('click', function(e){

		if (e.target.matches('.catalogo-item')) {
			console.log(e.target.dataset.id)
		}

	}, false)

}, true)

function cargarCategorias(){
	fetch(srv.url()+'categoria/consulta_rest')
	.then(function(resp){
		return resp.json()
	})
	.then(function(resp){
		// console.log(resp[0])
		for(c in resp){
			categoriaArray.push(resp[c])
		}
		crearCatalogo()
		
	})
	.catch(function(err){
		console.log(err.message)
	})
}

function cargarProductos(id){
	let data = new FormData()
	data.append('id',id)

	fetch(srv.url()+'producto/consulta_rest_v2',{
		body : data,
		method : 'post'
	})
	.then(function(resp){
		return resp.json()
		for(p in resp){
			productoArray.push(resp[p])
		}

	})
	.then(function(resp){
		console.log(resp)
	})
	.catch(function(err){
		console.log(err.message)
	})
}

function crearCatalogo(){
	catalogo_cont.innerHTML = ''

	for(c in categoriaArray){

		let card = document.createElement('div')
		let img = document.createElement('img')
		let text = document.createElement('div')

		card.setAttribute('class','catalogo-card')
		img.setAttribute('class', 'rounded float-left catalogo-item')
		img.setAttribute('src', srv.url()+categoriaArray[c].cat_imagen)
		img.setAttribute('data-id', categoriaArray[c].cat_codigo)
		text.setAttribute('class', 'catalogo-text')
		text.textContent = categoriaArray[c].cat_nombre

		card.appendChild(img)
		card.appendChild(text)

		catalogo.appendChild(card)
	}


}