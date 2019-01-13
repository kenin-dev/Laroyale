var categoriaArray = new Array()
var productoArray  = new Array()
var ordenArray = new Array()
var mesasArray = new Array()

var pedidoRAM = {
	'tipo' : 1,
	'destino' : '',
	'referencia': '',
	'subtotal' : 0 
} 

const b_registrar = document.getElementById('b-registrar')
const mostrador_ui = document.getElementById('mostrador')
const catalogo_titulo = document.getElementById('catalogo-titulo')
const table_orden = document.getElementById('tb-orden')

document.addEventListener('DOMContentLoaded', function(){

	b_registrar.disabled = false
	callCategorias()
	// callMesas()

	descicionTipoPedido(document.getElementById('pedidoTipo').value)


	document.addEventListener('click', function(e){

		if (e.target.matches('.catalogo-item')) {
			callProductos(e.target.dataset.id,e.target.dataset.nombre)
		}

		if (e.target.matches('#catalogo-inicio')) {
			callCategorias()
		}

		if (e.target.matches('.prod-i')) {
			let i = e.target.dataset.id
			let n = e.target.dataset.abrev+' '+e.target.dataset.nombre
			let p = e.target.dataset.precio
			agregarProducto(i,n,p)
			catalogoCategorias()
		}

		if (e.target.matches('.b-eliminar')) {
			ordenArray.splice(e.target.dataset.indice,1)
			mostrarOrden()
		}

		if (e.target.matches('.b-detalle')) {
			let inp = document.getElementById('i-modalDetalle')
			inp.value = ordenArray[e.target.dataset.indice].detalle
			inp.setAttribute('data-indice', e.target.dataset.indice)
			$('#modalDetalle').modal('show')

		}

		if (e.target.matches('#b-modalDetalle')) {
			let valor = document.getElementById('i-modalDetalle')
			let ind = valor.dataset.indice
			ordenArray[ind].detalle = valor.value
			$('#modalDetalle').modal('hide')
			mostrarOrden()

		}

		if (e.target.matches('#b-registrar')) {
			// not.exito('Registro','Enviando datos...')
			// not.wait('Registro','Enviando datos...')
			if (validarDatos() == 3) {
				b_registrar.disabled = true
				not.wait('Registro','Enviando datos...')
				registrarPedido_Ajx()
			}
		}

	}, false)

	document.addEventListener('keyup',function(e){

		if (e.target.matches('.i-cantidad')) {

			let ind = e.target.dataset.indice
			let val = e.target.value
			let precio = ordenArray[ind].precio
			if (val.length > 0) {
				let total  = parseFloat(val*precio).toFixed(2)
				ordenArray[ind].cantidad = val
				ordenArray[ind].total = total
				mostrarOrden()
			}

		}

	}, false)


	document.addEventListener('change',function(e){

		if (e.target.matches('#pedidoTipo')) {
			// console.log(e.target.value)
			descicionTipoPedido(e.target.value)
		}

		if (e.target.matches('.i-cantidad')) {

			let ind = e.target.dataset.indice
			let val = e.target.value
			let precio = ordenArray[ind].precio
			if (val.length > 0) {
				let total  = parseFloat(val*precio).toFixed(2)
				ordenArray[ind].cantidad = val
				ordenArray[ind].total = total
				mostrarOrden()
			}

		}

	}, false)

}, true)

// CATALOGO
function limpiar(){
	mostrador_ui.innerHTML = ''
}

function callCategorias(){
	categoriaArray = []
	fetch(srv.url()+'categoria/consulta_rest')
	.then(function(resp){
		return resp.json()
	})
	.then(function(resp){
		// console.log(resp[0])
		for(c in resp){
			categoriaArray.push(resp[c])
		}
		catalogoCategorias()
		
	})
	.catch(function(err){
		console.log(err.message)
	})
}

function callProductos(id,nom){
	productoArray = []
	let data = new FormData()
	data.append('id',id)

	fetch(srv.url()+'producto/consulta_rest_v2',{
		body : data,
		method : 'post'
	})
	.then(function(resp){
		return resp.json()
		
	})
	.then(function(resp){
		// console.log(resp)
		for(p in resp){
			productoArray.push(resp[p])
		}
		catalogoProductos(nom)
	})
	.catch(function(err){
		console.log(err.message)
	})
}

function callMesas(){
	fetch(srv.url()+'mesa/consulta_rest')
	.then(function(resp){
		return resp.json()
	})
	.then(function(resp){
		for(m in resp){	
			mesasArray.push(resp[m])
		}
		// console.log(resp)
	})
	.catch(function(err){
		console.log(err.message)
	})
}

function catalogoCategorias(){
	mostrador_ui.innerHTML = ''
	catalogo_titulo.textContent = 'Catalogo de productos'

	let catalogo = document.createElement('div')
	catalogo.setAttribute('class', 'catalogo')
	mostrador_ui.appendChild(catalogo)

	for(c in categoriaArray){

		let card = document.createElement('div')
		let img  = document.createElement('img')
		let text = document.createElement('div')

		card.setAttribute('class','catalogo-card')
		img.setAttribute('class', 'rounded float-left catalogo-item')
		img.setAttribute('src', srv.url()+categoriaArray[c].cat_imagen)
		img.setAttribute('data-id', categoriaArray[c].cat_codigo)
		img.setAttribute('data-nombre', categoriaArray[c].cat_nombre)
		text.setAttribute('class', 'catalogo-text')
		text.textContent = categoriaArray[c].cat_nombre

		
		card.appendChild(img)
		card.appendChild(text)
		catalogo.appendChild(card)
		// mostrador_ui.appendChild(card)
	}

}

function catalogoProductos(categoria){
	mostrador_ui.innerHTML = ''

	catalogo_titulo.textContent = categoria

	let carta  = document.createElement('ul')
	let inicio = document.createElement('a')
	let icono  = document.createElement('i')

	carta.setAttribute('class', 'list-group')
	inicio.setAttribute('id','catalogo-inicio')
	inicio.setAttribute('class','btn btn-primary btn-lg text-light')
	icono.setAttribute('class','ti-layout-grid2')
	// inicio.textContent = 'Catalogo'

	mostrador_ui.appendChild(carta)
	inicio.appendChild(icono)
	carta.appendChild(inicio)

	for(p in productoArray){

		let producto = document.createElement('li')
		let precio = document.createElement('p')
		let b_elegir = document.createElement('button')

		producto.setAttribute('class','list-group-item list-group-item-action b-y')
		b_elegir.setAttribute('class','btn btn-primary prod-i')
		b_elegir.setAttribute('data-id',productoArray[p].prod_codigo)
		b_elegir.setAttribute('data-nombre',productoArray[p].prod_nombre)
		b_elegir.setAttribute('data-precio',productoArray[p].prod_precio)
		b_elegir.setAttribute('data-abrev', productoArray[p].prod_categoria_abrev)
		b_elegir.textContent = 'Elegir'
		precio.setAttribute('class','text-danger')
		producto.textContent = productoArray[p].prod_nombre
		precio.textContent = productoArray[p].prod_precio
		producto.appendChild(precio)
		producto.appendChild(b_elegir)
		
		carta.appendChild(producto)
	}

}

// CESTA
function agregarProducto(id,nombre,precio,){

	try{
		let total = parseFloat(precio*1).toFixed(2)
		ordenArray.push({
			'id'      : id,
			'nombre'  : nombre,
			'precio'  : precio,
			'cantidad': 1,
			'total'   : total,
			'detalle' : ''
		})

		mostrarOrden()
		// console.log(ordenArray)

	}catch(e){
		not.aviso('Aviso','error al agregar producto','topCenter')
		console.log(e.message)
	}	
}

function mostrarOrden(){
	table_orden.innerHTML = ''
	if (ordenArray.length > 0) {

		let pago_total = 0
		for (x in ordenArray) {
			let fila = document.createElement('tr')
			let producto = document.createElement('td')
			let precio = document.createElement('td')
			let total  = document.createElement('td')
			let cantidad = document.createElement('td')
			let accion = document.createElement('td')

			let tx_producto = document.createElement('p')
			let tx_detalle  = document.createElement('small')
			let b_eliminar  = document.createElement('span')
			let b_detalle   = document.createElement('span')
			let i_cantidad  = document.createElement('input')

			tx_producto.setAttribute('class', 'text-dark font-weight-bold')
			b_eliminar.setAttribute('class', 'btn btn-danger text-light ti-trash b-eliminar')
			b_eliminar.setAttribute('title', 'eliminar')
			b_eliminar.setAttribute('data-indice', x)
			b_detalle.setAttribute('class', 'btn btn-warning text-dark ti-view-list b-detalle')
			b_detalle.setAttribute('title', 'detalle')
			b_detalle.setAttribute('data-indice', x)

			i_cantidad.setAttribute('type','number')
			i_cantidad.setAttribute('minlength',1)
			i_cantidad.setAttribute('maxlength',5)
			i_cantidad.setAttribute('onkeydown',"javascript: return event.keyCode == 69 ? false : true")
			i_cantidad.setAttribute('class','form-control text-center i-cantidad')
			i_cantidad.setAttribute('value',ordenArray[x].cantidad)
			i_cantidad.setAttribute('data-indice',x)
			
			tx_detalle.setAttribute('class', 'text-danger')
			accion.appendChild(b_eliminar)
			accion.appendChild(b_detalle)

			tx_producto.textContent = ordenArray[x].nombre
			tx_detalle.textContent = ordenArray[x].detalle
			producto.appendChild(tx_producto)
			producto.appendChild(tx_detalle)
			precio.textContent = ordenArray[x].precio
			total.textContent = ordenArray[x].total

			cantidad.appendChild(i_cantidad)
			fila.appendChild(producto)
			fila.appendChild(precio)
			fila.appendChild(cantidad)
			fila.appendChild(total)
			fila.appendChild(accion)
			table_orden.appendChild(fila)

			pago_total = parseFloat(pago_total) + parseFloat(ordenArray[x].total)
			// console.log('+ '+ordenArray[x].total)
		}
		pedidoRAM.subtotal = pago_total

		let fila_total  = document.createElement('tr')
		let total_texto = document.createElement('td')
		let total_valor = document.createElement('td')
		total_texto.setAttribute('colspan', 2)
		total_texto.setAttribute('class', 'font-weight-bold text-center')
		total_texto.textContent = 'Total'
		total_valor.setAttribute('colspan', 3)
		total_valor.setAttribute('class', 'font-weight-bold text-right lead')
		total_valor.textContent = (pedidoRAM.subtotal).toFixed(2)
		fila_total.appendChild(total_texto)
		fila_total.appendChild(total_valor)
		table_orden.appendChild(fila_total)

	}else{
		let fila = document.createElement('tr')
		let mns  = document.createElement('td')
		mns.setAttribute('class', 'text-center')
		mns.setAttribute('colspan', 4)
		mns.textContent = 'Use el catalogo para agregar productos.'
		fila.append(mns)
		table_orden.appendChild(fila)
	}

}

function descicionTipoPedido(tipo){
	let pres = document.getElementById('destinoPres')
	let del = document.getElementById('destinoDel')

	switch (tipo) {
		case '1':
			del.removeAttribute('name')
			del.style.display = 'none';
			pres.setAttribute('name', 'pedidoDestino')
			pres.style.display = 'block';
			break;

		case '2':
			pres.removeAttribute('name')
			pres.style.display = 'none';
			del.setAttribute('name', 'pedidoDestino')
			del.style.display = 'block';
			break;
	}
}

function validarDatos(){
	let resp = 0
	pedidoRAM.referencia = document.getElementById('pedidoReferencia').value

	if (document.getElementById('pedidoTipo').value.length > 0) {
		pedidoRAM.tipo = document.getElementById('pedidoTipo').value
		resp++
	}else{
		not.aviso('Datos','Tipo de pedido no expecificado')
	}

	if (document.querySelector('[name=pedidoDestino]').value.length > 0) {
		pedidoRAM.destino = document.querySelector('[name=pedidoDestino]').value
		resp++
	}else{
		not.aviso('Datos','Destino del pedido no especificado')
	}

	if (parseFloat(pedidoRAM.subtotal) > 0 && ordenArray.length > 0) {
		resp++
	}else{
		not.aviso('Datos','No se ha seleccionado ningun producto')
	}

	return resp

}

function registrarPedido(){
	let data = {
		pedido : pedidoRAM,
		detalle : ordenArray 
	}

	// data.append('pedido',pedidoRAM)
	// data.append('detalle',ordenArray)

	fetch(srv.url()+'pedido/registrar',{
		method : 'POST',
		body : JSON.stringify(data),
		headers:{
		    'Content-Type': 'application/json'
		}
	})
	.then(function(resp){
		return resp.text()
	})
	.then(function(resp){
		let rs = JSON.stringify(resp)
		console.log(rs)
		// if (resp.codigo == 1) {
		// 	not.exito('Genial','Pedido registrado con exito')
		// }else{
		// 	not.aviso('Oh no',resp.mensaje)
		// }
	})
	.catch(err => {
		console.log(err.message)
	})
}

function registrarPedido_Ajx(){
	try {

		$.ajax({
			url: srv.url()+'pedido/registrar',
			type: 'post',
			dataType: 'json',
			data: {
				pedido : pedidoRAM,
				detalle : ordenArray
			},
			success: function(resp){
				console.log(resp)
				switch (resp.codigo) {
					case '0':
						not.error('Oh no!',resp.mensaje)
						break;
					case '1':
						not.exito('Genial!',resp.mensaje)
						limpiar()
						// alert('joola')
						setTimeout(function(){
							window.location = srv.url()+'pedido'
							// console.log('joola')
						}, 900)
						break;
				}
			}

		})

	} catch(e) {
		// statements
		console.log(e.message);
	}
}

function limpiar(){
	pedidoRAM  = []
	ordenArray = []

}