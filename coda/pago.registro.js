
var productosG = new Array()
var cuentasArray = new Array()
var pedidoID;
const contenedorForm = document.getElementById('contenidoPagos')
// const consolaTest = document.getElementById('consola')
// pagosGlobal
const b_agr = document.getElementById('b-agregar')
const b_pag = document.getElementById('b-pagar')

document.addEventListener('DOMContentLoaded', function(){

	pedidoID = get_id('pedidoID').value
	cargarProductos()
	b_agr.disabled = false
	b_pag.disabled = false

	document.addEventListener('click',function(e){
		if (e.target.matches('#b-agregar')) {
			crearPago()
		}

		if (e.target.matches('#b_pag')) {

		}

		if (e.target.matches('.item-disp')) {
			let pago = e.target.dataset.pagoind
			let producto = productosG[e.target.dataset.indice]
			
			cuentasArray[pago].productos.push(producto)
			productosG[e.target.dataset.indice].estado = false
			listarDisponibles()
			listarSeleccionado()	
		}

		if (e.target.matches('.item-sel')) {
			let prod_ind_pag = e.target.dataset.productoindice
			let productoid = e.target.dataset.productoid
			let pago = e.target.dataset.pagoind
			let prod_ind_glob = obtenerIndiceProducto(productoid)
			console.log('indice :'+prod_ind_pag)

			cuentasArray[pago].productos.splice(prod_ind_pag,1)
			productosG[prod_ind_glob].estado = true
			
			listarDisponibles()
			listarSeleccionado()
		}
	})

}, true )


function cargarProductos(){
	try{
		if (pedidoID.length > 0) {
			$.ajax({
				url: srv.url()+'DetallePedido/consulta_rest',
				method: 'POST',
				data: {
					'pedido' : pedidoID
				},
				success: function(resp){
					var resp = JSON.parse(resp)
					var estado = resp.resp_id
					switch (estado) {
						case 1:
							let data = resp.resp_content
							for (var i = 0; i < data.length; i++) {
								
								productosG.push({
									'id' : data[i].dp_id,
									'nombre' : data[i].dp_producto,
									'precio' : data[i].dp_precio,
									'cantidad' : data[i].dp_cantidad,
									'importe' : data[i].dp_importe,
									'detalle' : data[i].dp_detalle,
									'estado' : true
								})
							}
							// console.log(productosG)
							break;
					}
				}
			})
		}

		return true

	}catch(err){
		return false
		console.log('cargarProductos dice :'+err.message)
	}
	
}

var crearPago = function(){

	let idx = parseInt(cuentasArray.length)+1
	let lista_sel = 'sel'+idx
	let inp_subtotal = 'sub'+idx
	let inp_recibido = 'rec'+idx
	let inp_devuelto = 'dev'+idx

	cuentasArray.push({
		'pedidoid' : pedidoID,
		'pago_id' : idx,
		'lista_sel' : lista_sel,
		'cliente_id' : 0,
		'cliente_nombre' : 'No Especificado',
		'input_subtotal' : inp_subtotal,
		'input_recibido' : inp_recibido,
		'input_devuelto' : inp_devuelto,
		'recibido' : 0,
		'devuelto' : 0,
		'productos' : []
	})
			
	let indice = parseInt(cuentasArray.length)-1

	//card 
	var card = document.createElement('div')
	var cardhead = document.createElement('h5')
	var cardbody = document.createElement('div')

	card.setAttribute('class','card border')
	card.setAttribute('data-idform',idx)
	cardhead.setAttribute('class','card-title')
	cardbody.setAttribute('class','card-body')
	cardhead.textContent = 'Cuenta #'+idx
	//

	//form 
	var contenidoCliente = document.createElement('div')
	var contenidoDni = document.createElement('div')
	var contenidoBuscar = document.createElement('div')
	var contenidoForm = document.createElement('div')
	var contenidoSubtotal = document.createElement('div')
	var contenidoRecibido = document.createElement('div')
	var contenidoDevuelto = document.createElement('div')


	

	contenidoCliente.setAttribute('class','col-md-6')
	contenidoDni.setAttribute('class','col-md-3 form-group')
	contenidoBuscar.setAttribute('class','col-md-3')
	contenidoForm.setAttribute('class', 'col-12 col-md-12 p-0')
	contenidoSubtotal.setAttribute('class','col-6 col-md-4')
	contenidoRecibido.setAttribute('class','col-6 col-md-4')
	contenidoDevuelto.setAttribute('class','col-6 col-md-4')

	var labelCliente = document.createElement('label')
	var inputCliente = document.createElement('input')
	var labelDni = document.createElement('label')
	var inputDni = document.createElement('input')
	var labelSubtotal = document.createElement('label')
	var inputSubtotal = document.createElement('input')
	var labelRecibido = document.createElement('label')
	var inputRecibido = document.createElement('input')
	var labelDevuelto = document.createElement('label')
	var inputDevuelto = document.createElement('input')

	labelCliente.textContent = 'Cliente'
	inputCliente.setAttribute('type','text')
	inputCliente.setAttribute('name','inputCliente')
	inputCliente.setAttribute('class','form-control')
	inputCliente.setAttribute('readonly','')

			labelDni.textContent = 'Dni'
			inputDni.setAttribute('type','text')
			inputDni.setAttribute('name','inputDni')
			inputDni.setAttribute('class','form-control')
			inputDni.setAttribute('readonly','')
			labelSubtotal.textContent = 'Subtotal'
			inputSubtotal.setAttribute('type','text')
			inputSubtotal.setAttribute('name','inputDni')
			inputSubtotal.setAttribute('class','form-control')
			inputSubtotal.setAttribute('readonly','')
			labelRecibido.textContent = 'Recibido'
			inputRecibido.setAttribute('type','text')
			inputRecibido.setAttribute('name','inputDni')
			inputRecibido.setAttribute('class','form-control')
			labelDevuelto.textContent = 'Devuelto'
			inputDevuelto.setAttribute('type','text')
			inputDevuelto.setAttribute('name','inputDni')
			inputDevuelto.setAttribute('class','form-control')
			inputDevuelto.setAttribute('readonly','')

			var buttonBuscar = document.createElement("button")
			var labelBuscar  = document.createElement('hr')
			var iconoBuscar  = document.createElement('i')
			iconoBuscar.setAttribute('class','ti-search')
			labelBuscar.setAttribute('style','border-color:transparent')
			buttonBuscar.setAttribute('class', 'btn btn-dark text-light')
			buttonBuscar.appendChild(iconoBuscar)
			// 

			var contenedorListas = document.createElement('div')
			var contSeleccion = document.createElement('div')
			var contDisponible = document.createElement('div')
			var listaSeleccion = document.createElement('ul')
			var listaDisponible = document.createElement('div')
			var labelSeleccion = document.createElement('b')
			var labelDisponible = document.createElement('b')
			labelSeleccion.setAttribute('class','text-center')
			labelDisponible.setAttribute('class','text-center')
			labelSeleccion.textContent = 'Seleccion'
			labelDisponible.textContent = 'Consumo'
			contenedorListas.setAttribute('class','col-md-12')
			contSeleccion.setAttribute('class','col-md-6')
			contDisponible.setAttribute('class','col-md-6')
			listaSeleccion.setAttribute('class','tree tree-blue')
			listaSeleccion.setAttribute('id',lista_sel)
			listaDisponible.setAttribute('class','tree tree-green lista_disponible')
			listaDisponible.setAttribute('data-pagoind',indice)

			// incluciones
			contenidoCliente.appendChild(labelCliente)
			contenidoCliente.appendChild(inputCliente)
			contenidoDni.appendChild(labelDni)
			contenidoDni.appendChild(inputDni)
			contenidoBuscar.appendChild(labelBuscar)
			contenidoBuscar.appendChild(buttonBuscar)

			contenidoSubtotal.appendChild(labelSubtotal)
			contenidoSubtotal.appendChild(inputSubtotal)
			contenidoRecibido.appendChild(labelRecibido)
			contenidoRecibido.appendChild(inputRecibido)
			contenidoDevuelto.appendChild(labelDevuelto)
			contenidoDevuelto.appendChild(inputDevuelto)

			contDisponible.appendChild(labelDisponible)
			contDisponible.appendChild(listaDisponible)
			contSeleccion.appendChild(labelSeleccion)
			contSeleccion.appendChild(listaSeleccion)
			contenedorListas.appendChild(contDisponible)
			contenedorListas.appendChild(contSeleccion)

			cardbody.appendChild(cardhead)
			cardbody.appendChild(contenidoDni)
			cardbody.appendChild(contenidoCliente)
			cardbody.appendChild(contenidoBuscar)

			contenidoForm.appendChild(contenidoSubtotal)
			contenidoForm.appendChild(contenidoRecibido)
			contenidoForm.appendChild(contenidoDevuelto)
			cardbody.appendChild(contenidoForm)

			card.appendChild(cardbody)
			card.appendChild(contenedorListas)
			contenedorForm.appendChild(card)

			listarDisponibles()
			listarSeleccionado()
			// mostrarProductos(contenedorLista,indiceForm)

		// }
	
}

function listarDisponibles(){

	var objetivo = document.getElementsByClassName('lista_disponible')
	for(let z=0;z<objetivo.length;z++){

		objetivo[z].innerHTML = ''
		for (var i = 0; i < productosG.length; i++) {
			if (productosG[i].estado == true) {
				let item = document.createElement('li')
				// item.setAttribute('href','javascript:void(0)')
				item.setAttribute('class','item-disp')
				item.setAttribute('data-producto',productosG[i].id)
				item.setAttribute('data-indice',i)
				item.setAttribute('data-pagoind',objetivo[z].dataset.pagoind)
				item.textContent = productosG[i].nombre+' ('+productosG[i].precio+')'
				objetivo[z].appendChild(item)
			}
		}

	}

}

function listarSeleccionado(){
	for (var i = 0; i < cuentasArray.length; i++) {

		let contenedor = document.getElementById(cuentasArray[i].lista_sel)
		contenedor.innerHTML = ''
		for (var j = 0; j < cuentasArray[i].productos.length; j++) {
			let item = document.createElement('li')
			let icon = document.createElement('i')
			// item.setAttribute('href','javascript:void(0)')
			icon.setAttribute('class', 'ti-check')
			item.setAttribute('class','item-sel')
			item.setAttribute('data-productoindice',j)
			item.setAttribute('data-productoid',cuentasArray[i].productos[j].id)
			item.setAttribute('data-pagoind',i)
			item.textContent = cuentasArray[i].productos[j].nombre+' ('+cuentasArray[i].productos[j].precio+')'
			item.appendChild(icon)
			contenedor.appendChild(item)
		}

	}
}

var obtenerIndiceProducto = function(id){
	for(let i=0;i<productosG.length;i++){
		if (productosG[i].id === id) {
			return i
		}
	}
}

function calcular(){
	for (var i = 0; i < cuentasArray.length; i++) {
		let total = 0;
		for (var j = 0; j < cuentasArray[i].productos.length; j++) {
			total = parseInt(total + cuentasArray[i].productos[j].precio)
		}

	}
}