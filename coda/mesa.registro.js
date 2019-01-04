const registrar = document.getElementById('b-registrar')
var mesasArray = new Array()

document.addEventListener('DOMContentLoaded',function(){
	registrar.disabled = false
	cargarMesas()
	document.addEventListener('submit', function(e){

		if (e.target.matches('#form-registro')) {
			let num = document.querySelector('[name=inputNumero]').value
			if (mesasArray.includes(num)) {
				e.preventDefault()

				not.aviso('Cuidado','Ya existe una mesa con ese numero','topCenter')
			}else{
				console.log('no incluye')
			}
		}


	} , false)

}, true)

function cargarMesas(){
	const contenedor = document.getElementById('contenidoMesas')
	fetch(srv.url()+'mesa/consulta_rest')
	.then(function(resp){
		
		return resp.json()
	})
	.then(function(data){
		contenedor.innerHTML = ''
		// let data = JSON.parse(resp)
		let titulo = document.createElement('h4')
		let ul = document.createElement('ul')
		titulo.setAttribute('class', 'font-weight-bold')
		titulo.textContent = 'Mesas actuales'
		ul.setAttribute('class', 'list-group text-center')
		ul.appendChild(titulo) 
		contenedor.appendChild(ul)

		// console.log(data)
		for(let i=0;i<data.length;i++){
			mesasArray.push(data[i].mes_numero)
			let li = document.createElement('li')
			// let icon = document.createElement('i')
			// icon.setAttribute('class', 'ti-layout-accordion-merged')
			li.setAttribute('class', 'list-group-item')
			li.textContent = data[i].mes_numero
			// li.appendChild(icon)
			ul.appendChild(li)
		}
	})
	.catch(function(err){
		console.log(err.message)
	})
}