let cuentasArray = new Array()
let consumoArray   = new Array()

const contenedorCuotas = document.getElementById('contenedor_cuotas')
const b_agregar   = document.getElementById('b-agregar')
const b_registrar = document.getElementById('b-registrar')
const e_pedido    = document.getElementById('e_pedido')
const bm_agregar  = document.getElementById('md_agregar')
const f_consumos  = document.getElementById('formConsumos')
const f_consumos_c  = document.getElementById('formConsumos_content')
const ch_marcar   = document.getElementById('ch_marcarTodo')
const m_cliente   = document.getElementById('modalCliente')
const listaClientes  = document.getElementById('md_filtro_cliente')

document.addEventListener('DOMContentLoaded', function(){

	cargarConsumos(e_pedido.dataset.id)
	b_agregar.disabled = false
	b_registrar.disabled = false

}, true)

document.addEventListener('click', (e) =>{

	if (e.target.matches('#b-registrar')) {

		// $("#modalCliente").modal('show')
	}

	if (e.target.matches('#b-agregar')) {
		
		nuevaCuenta()
		UICuentas()
	}

	if (e.target.matches('.cons_agrega')) {
		
		modalConsumos(e.target.dataset.cuenta)
	}

	if (e.target.matches('.cons_eliminar')) {
		
		let cuenta = e.target.dataset.cuenta
		let indice = e.target.dataset.consumo
		let prods  = cuentasArray[cuenta].consumo[indice].indices
		
		for(let p=0;p < prods.length; p++){
			
			consumoArray[prods[p]].estado = true
		}
		cuentasArray[cuenta].consumo.splice(indice,1)
		calculosCuenta(cuenta)
		UICuentas()
	}

	if (e.target.matches('.b-buscarCliente')) {
		// let cuenta = e.target.dataset.cuenta
		m_cliente.setAttribute('data-cuenta', e.target.dataset.cuenta)
		$("#modalCliente").modal('show')
	}

	if (e.target.matches('.item-cliente')) {

		let c = m_cliente.dataset.cuenta
		cuentasArray[c].cliente_id = e.target.dataset.id 
		cuentasArray[c].cliente = e.target.dataset.cliente
		$("#modalCliente").modal('hide')
		UICuentas() 
	}

	if (e.target.matches('.cli-eliminar')) {
		
		cuentasArray[e.target.dataset.cuenta].cliente_id = 0
		cuentasArray[e.target.dataset.cuenta].cliente = ''
		UICuentas()
	}

	if (e.target.matches('#b-registrarCliente')) {
		let dni = document.getElementById('nuevoDni').value
		let nom = document.getElementById('nuevoNombre').value
		let pat = document.getElementById('nuevoPaterno').value
		let mat = document.getElementById('nuevoMaterno').value
		let cuenta = m_cliente.dataset.cuenta
		if (valRegistroCliente(dni,nom,pat) == true) {
			let datos = new FormData()
			datos.append('dni',dni)
			datos.append('nombres',nom)
			datos.append('paterno',pat)
			datos.append('materno',mat)

			registroCliente(datos,cuenta)
		}

	}

}, false)

document.addEventListener('submit', (e)=>{
	
	e.preventDefault()
	if (e.target.matches('#formConsumos')) {
		
		let productos = document.getElementsByClassName('consumo-item')
		let cuenta = e.target.dataset.cuenta

		for(let i=0; i < productos.length; i++){

			if (productos[i].checked) {

				let i_prod = productos[i].dataset.indice
				let vrc = verificarProducto(cuenta,consumoArray[i_prod].codigo)
				if (vrc == 'false') {

					cuentasArray[cuenta].consumo.push({
						'codigo'   : consumoArray[i_prod].codigo,
						'nombre'   : consumoArray[i_prod].producto,
						'precio'   : consumoArray[i_prod].precio,
						'cantidad' : 1,
						'importe'  : parseFloat(consumoArray[i_prod].precio)*1,
						'indices'  : [i_prod]
					})

				}else{

					let n_cantidad = cuentasArray[cuenta].consumo[vrc].cantidad + 1
					let a_precio   = cuentasArray[cuenta].consumo[vrc].precio
					cuentasArray[cuenta].consumo[vrc].cantidad = n_cantidad
					cuentasArray[cuenta].consumo[vrc].importe =  parseFloat(n_cantidad*a_precio)
					cuentasArray[cuenta].consumo[vrc].indices.push(i_prod)

				}
				consumoArray[i_prod].estado = false
			}

		}

		calculosCuenta(cuenta)
		$("#modalConsumos").modal('hide')
		UICuentas()
		ch_marcar.checked = false

	}

}, false)

document.addEventListener('change', function(e){

	if (e.target.matches('#ch_marcarTodo')) {

		let estadoMT = (e.target.checked) ? true : false
		marcarProductosTodo(estadoMT)
		// e.target.checked = false
	}

	if (e.target.matches('.item-comprob')) {

		let cuenta = e.target.dataset.cuenta
		let comp   = e.target.value
		let porc    = 0  
		switch (comp) {
			case '1':
				porc =  0.18
				break;
			case '2':
				porc = 0
				break;
			case '3':
				porc = 0
				break;
		}
		// let calculo = parseFloat(cuentasArray[cuenta].subtotal)*igv
		cuentasArray[cuenta].porcentaje = porc
		cuentasArray[cuenta].t_comprobante = parseInt(comp)
		calculosCuenta(cuenta)
	}

}, false)

document.addEventListener('keyup', e => {

	if (e.target.matches('#in-FiltroCliente')) {

		filtroCliente(e.target.value)
	}

	if (e.target.matches('[name=numComprobante]')) {

		let cuenta = e.target.dataset.cuenta 
		cuentasArray[cuenta].n_comprobante = e.target.value
	}

}, false)

function cargarConsumos(id){
	let data = new FormData()
	data.append('pedido',id)
	fetch(srv.url()+'DetallePedido/consulta_rest',{
		body : data,
		method: 'post'
	})
	.then(resp => {
		return resp.json()
	})
	.then(resp => {
			
		for(rs in resp){
			for(let i=0;i<resp[rs].pdet_cantidad;i++){

				consumoArray.push({
					'codigo'   : resp[rs].pdet_codigo,
					'producto' : resp[rs].pdet_producto_nombre,
					'precio'   : resp[rs].pdet_precio,
					'cantidad' : resp[rs].pdet_cantidad,
					'importe'  : resp[rs].pdet_importe,
					'detalle'  : resp[rs].pdet_detalle,
					'estado'   : true
				})

			}
		}

	})
	.catch(err => {
		console.log(err.message)
	})
}

function calculosCuenta(cuenta){
	let porc  = cuentasArray[cuenta].porcentaje
	let sub   = 0
	let total = 0
	let igv   = 0

	if (cuentasArray[cuenta].consumo.length > 0) {

		for(let x = 0;x < cuentasArray[cuenta].consumo.length;x++){
			sub = sub + cuentasArray[cuenta].consumo[x].importe
		}
		igv = sub * porc
		total = sub-igv
	}
	
	cuentasArray[cuenta].subtotal = sub
	cuentasArray[cuenta].igv = igv
	cuentasArray[cuenta].total = total

	UICuentas()
}

function limpiarRegistroCliente(){
	document.getElementById('nuevoDni').value = ''
	document.getElementById('nuevoNombre').value = ''
	document.getElementById('nuevoPaterno').value = ''
	document.getElementById('nuevoMaterno').value = ''
}

function filtroCliente(valor){
	let data = new FormData()
	data.append('valor',valor)
	fetch(srv.url()+'cliente/consulta_rest',{
		body: data,
		method: 'POST'
	})
	.then(resp => {
		return resp.json()
	})
	.then(resp => {

		UIClientes(resp)
	})
	.catch(err => {
		console.log(err.message)
	})
}

function UIClientes(data){
	let html = ''
	if (data.length > 0) {

		for(let i=0;i < data.length; i++){
			html += `
			<tr>
				<td>${data[i].cli_dni}</td>
				<td>${data[i].cli_nombres+' '+data[i].cli_paterno+' '+data[i].cli_materno}</td>
				<td>
					<button class="btn btn-primary ti-check item-cliente" 
					data-id="${data[i].cli_codigo}" 
					data-cliente="${data[i].cli_nombres+' '+data[i].cli_paterno+' '+data[i].cli_materno}">
					</button>
				</td>
			</tr>`
		}

	}else{
		html += `
		<tr>
			<td class="text-center" colspan="3">Sin datos</td>
		</tr>`
	}
	listaClientes.innerHTML= html
}

function verificarProducto(c,p){
	let resp = 'false'
	for(let i=0;i < cuentasArray[c].consumo.length;i++){
		if (cuentasArray[c].consumo[i].codigo == p) {
			resp = i
		}
	}
	return resp
}

function registroCliente(data,cue){
	fetch(srv.url()+'cliente/registro_rest',{
		body : data,
		method : 'POST'
	})
	.then(res => {
		return res.json()
	})
	.then(res => {
		limpiarRegistroCliente()
		if (res.codigo == 1) {

			not.exito('Genial!',res.mensaje)
			cuentasArray[cue].cliente_id = res.contenido.id
			cuentasArray[cue].cliente = res.contenido.nombre
			$("#modalCliente").modal('hide')
			UICuentas()
		}else{

			not.error('Oh no!',res.mensaje)
		}
	})
	.catch(err => {
		console.log(err.message)
	})
}

function valRegistroCliente(d,n,p){
	let res = true
	if (d.length <= 0) {
		not.aviso('Cliente','dni no especificado')
		res = false
	}

	if (n.length <= 0) {
		not.aviso('Cliente','Olvidaste el nombre')
		res = false
	}

	if (p.length <= 0) {
		not.aviso('Cliente','el apellido paterno es necesario')
		res = false
	}
	return res
}

function modalConsumos(cuenta){
	$("#modalConsumos").modal('show')
	let cadena = ''
	for(d in consumoArray){
		if (consumoArray[d].estado == true) {
			cadena += `
			<div class="col-md-6 col-lg-6 col-12 ">
				<div class="form-check">
					<input data-indice="${d}" class="form-check-input consumo-item" type="checkbox" id="${consumoArray[d].codigo+d}">
				  	<label class="form-check-label" for="${consumoArray[d].codigo+d}">
				    	1 ${consumoArray[d].producto}
				  	</label>
				  	<small class="text-danger">${consumoArray[d].precio} S/</small>
				</div>
			</div>`
		}
	}
	f_consumos.setAttribute('data-cuenta', cuenta)
	f_consumos_c.innerHTML = cadena
}

function marcarProductosTodo(bool){
	let items = document.getElementsByClassName('consumo-item')
	for(i in items){
		items[i].checked = bool
	}
}

function nuevaCuenta(){
	cuentasArray.push({
		'id' : cuentasArray.length+1,
		'cliente_id' : 0,
		'cliente' : '',
		't_comprobante' : 3,
		'n_comprobante' : '',
		'descuento' : 0,
		'igv'       : 0,
		'porcentaje': 0,
		'subtotal'  : 0,
		'total'     : 0,
		'consumo'   : []
	})
	UICuentas()
}

function UICuentas(){

	if (cuentasArray.length > 0) {

		let form = ''
		for(or in cuentasArray){

			let consumo = ''
			let comprob = ''
			let enl_eliminar = (cuentasArray[or].cliente_id == 0) 
			? `` 
			: `<a class="text-danger btn-link cli-eliminar" data-cuenta="${or}"
				style="cursor:pointer" href="javascript:void(0)" 
				>Eliminar</a>`  

			if (cuentasArray[or].consumo.length > 0) {
				for(c in cuentasArray[or].consumo){

					consumo += `
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<label>${cuentasArray[or].consumo[c].nombre}
							<small class="text-primary">(${cuentasArray[or].consumo[c].cantidad})</small>
						</label>
						&nbsp;
						<small class="text-danger">${parseFloat(cuentasArray[or].consumo[c].importe).toFixed(2)} S/</small>
						<button data-cuenta="${or}" data-consumo="${c}" class="btn btn-danger btn-sm ti-close cons_eliminar"></button>
					</li>
					`
					// stotal = stotal + cuentasArray[or].consumo[c].importe
				}
			}else{
				consumo = '<p class="text-center">sin consumo</p>'
			}

			switch (cuentasArray[or].t_comprobante) {
				case 1:
					comprob += `
						<option value="3">Nota de venta</option>
			            <option value="2">Boleta</option>
			            <option value="1" selected>Factura</option>`
					break;
				case 2:
					comprob += `
						<option value="3">Nota de venta</option>
			            <option value="2"selected>Boleta</option>
			            <option value="1">Factura</option>`
					break;
				case 3:
					comprob += `
						<option value="3" selected>Nota de venta</option>
			            <option value="2">Boleta</option>
			            <option value="1">Factura</option>`
					break;
			}


			form += `
			<div class="col-12 col-md-6 col-lg-6">
				<div class="card">
					<div class="card-header">
					 	<strong class="card-title">Cuenta ${cuentasArray[or].id}</strong>
					</div>
					<div class="card-body">
						<div class="row form-group">
	                        <div class="col col-md-12">
	                            <div class="input-group">
	                                <div class="input-group-btn">
	                                    <button class="btn btn-primary b-buscarCliente" data-cuenta="${or}">
	                                        <i class="ti-search"></i>
	                                    </button>
	                                </div>
	                                <input type="text" id="b-buscacliente" data-orden="${or}" value="${cuentasArray[or].cliente}" class="form-control" readonly disabled>
	                            	
	                            </div>
	                            ${enl_eliminar}
	                        </div>
	                    </div>	

	                    <div class="row">
	                        <div class="col-12 col-md-6 col-lg-6">
	                            <div class="form-group">
							 		<div class="form-group">
			                            <label for="">Comprobante</label>
			                            <select data-cuenta="${or}" class="form-control item-comprob">
			                                ${comprob}
			                            </select>
			                        </div>
			                    </div>
	                        </div>
	                        <div class="col-12 col-md-6 col-lg-6">
			                    <div class="form-group">
							 		<div class="form-group">
			                            <label for="">Nro Comprobante</label>
			                            <input data-cuenta="${or}" value="${cuentasArray[or].n_comprobante}" name="numComprobante" type="text" class="form-control">
			                        </div>
			                    </div>
	                        </div>
	                    </div>
						
						<div class="row">
	                        <div class="col-12 col-md-6 col-lg-6">
	                            <div class="form-group">
							 		<div class="form-group">
			                            <label for="">Descuento</label>
			                            <input type="text" class="form-control" value="${cuentasArray[or].descuento}" readonly>
			                        </div>
			                    </div>
	                        </div>
	                        <div class="col-12 col-md-6 col-lg-6">
			                    <div class="form-group">
							 		<div class="form-group">
			                            <label for="">Subtotal</label>
			                            <input value="${cuentasArray[or].subtotal}" type="text" class="form-control" readonly>
			                    	</div>
			                    </div>
	                        </div>
	                    </div>

	                    <div class="row">
	                        <div class="col-12 col-md-6 col-lg-6">
	                            <div class="form-group">
							 		<div class="form-group">
			                            <label for="">Total</label>
			                            <input value="${cuentasArray[or].total}" type="text" class="form-control text-primary text-center" readonly>
			                        </div>
			                    </div>
	                        </div>
	                    </div>

	                    <div class="row">
							<p class="pl-3">
								<a class="btn btn-dark btn-sm text-light cons_agrega" name="cons_agrega" data-cuenta="${or}">
									Consumo
									<i class="ti-plus"></i>
								</a>
							</p>
							<div class="col-12 p-1 jus border" id="cons_${cuentasArray[or].id}">
								<ul class="list-group list-group-flush">
									${consumo}
								</ul>
							</div>
						</div>

					</div>
				</div>
			</div>
			`;
		}
		contenedorCuotas.innerHTML = form

	}
}

