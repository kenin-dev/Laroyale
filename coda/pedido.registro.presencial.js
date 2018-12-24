var mem_pedido = {
	'fecha' : '',
	'subtotal' : 0,
	'tipo_consumo' : 'presencial',
	'destino' : '',
	'estado' : 'pendiente'
}

var mem_detalle = new Array();

document.addEventListener('DOMContentLoaded', function(){

	get_id('inputFecha').value = srv.fecha()
	detalle_mostrar()

	get_query('[name=editarCantidad]').addEventListener( 'change', function(e){

		// alert('keypresss')
		if (get_query('[name=editarPrecio]').value.length > 0 ) {
			let nimporte = parseFloat(get_query('[name=editarPrecio]').value*e.target.value).toFixed(2)
			get_query('[name=editarImporte]').value = nimporte
		}else{
			not.aviso('Aviso','Precio no encontrado, revise')
		}

	}, false )


	get_id('form_producto_editar').addEventListener( 'submit', function(e){
		e.preventDefault()
		try {
			let id = e.target.dataset.id;
			let precio = get_query('[name=editarPrecio]').value; 
			let cantidad,importe,detalle;

			if (get_query('[name=editarCantidad]').value.length > 0) {
				cantidad = get_query('[name=editarCantidad]').value
			}else{
				cantidad = 1
			}

			importe = parseFloat(precio*cantidad).toFixed(2);
			detalle = get_query('[name=editarDetalle]').value;


			mem_detalle[id].cantidad = cantidad
			mem_detalle[id].importe  = importe
			mem_detalle[id].detalle  = detalle
			
			detalle_mostrar()
			$('#modal_producto_editar').modal('hide')
			not.exito('Editar','datos actualizados','topRight')

		} catch(err) {
			console.log(err.message)
		}
		detalle_mostrar()
	}, false )

	get_id('PedidoCrear').addEventListener('click', function(){
		if (pedido_validar() > 0) {
			not.aviso('Datos :','se detectaron '+pedido_validar()+' error(es)')
		}else{
			// alert('validacion correcta')
			crear()
		}
	}, false)


}, false)

function ver_productos(id){
	
	$.ajax({
        url: srv.url()+'producto/categoria_productos_rest',
        type: 'POST',
        data: {categoria:id},
		success: function(resp){
			var data = JSON.parse(resp);
			var cadena = ""; 
			if (data.length > 0) {

	            get_id("modal_productos_titulo").innerHTML = data[0]['categoria'];
	              
	            for (var i = 0; i < data.length; i++) {
	                cadena += "<td>"+data[i]['categoria']+"</td>";
	                cadena += "<td>"+data[i]['nombre']+"</td>";
	                cadena += "<td>"+data[i]['precio']+"</td>";
	                cadena += "<td><button class='btn btn-primary prod-option' onclick='producto_elegir(event)' data-code='"+data[i]['id']+"'>";
	                cadena += "Elegir</button></td>";
	                cadena += "</tr>";
	            }
	            get_query("#modal_productos tbody").innerHTML = cadena;
	            $("#modal_productos").modal();
			}else{
				not.aviso("Aviso","Esta categoria no tiene productos",'topCenter');
			}
        }
    });
}

function producto_elegir(e){
	var elem = e.target.parentElement.parentElement.children;

	try {
		mem_detalle.push({
			'producto_id' : e.target.dataset.code,
			'producto_nombre' : elem[0].textContent+' '+elem[1].textContent,
			'precio'   : elem[2].textContent,
			'cantidad' : 1,
			'importe'  : (parseFloat(elem[2].textContent)*1).toFixed(2),
			'detalle'  : ''
		})
		$("#modal_productos").modal('hide');
		detalle_mostrar();

	} catch(err) {
		console.log(err.message);
	}
}	

function detalle_mostrar(){
	var table = get_query('#pedido_tabla tbody');
	if (mem_detalle.length > 0) {
	 	let cadena = "";
	 	for (var i=0; i < mem_detalle.length; i++){
	 		cadena += "<tr>";
	 		cadena += "<td>"+mem_detalle[i].producto_nombre+"<br>";
	 		cadena += "<small class='font-italic text-danger'>"+mem_detalle[i].detalle+"</small></td>";
	 		cadena += "<td>"+mem_detalle[i].precio+"</td>";
	 		cadena += "<td>"+mem_detalle[i].cantidad+"</td>";
	 		cadena += "<td>"+mem_detalle[i].importe+"</td>";
	 		// cadena += "<td>"+mem_detalle[i].detalle+"</td>";
	 		cadena += "<td><a href='javascript:detalle_eliminar("+i+")' class='btn btn-danger'><i class='ti-close'></i></a>&nbsp;";
	 		cadena += "<a href='javascript:detalle_editar("+i+")' class='btn btn-success'><i class='ti-pencil'></i></a></td>";
	 		cadena += "</tr>";
		}
		table.innerHTML = cadena;
	}else{
		table.innerHTML = "<tr class='text-center'><td colspan='6'><h4 class='f-light'>Ningun producto seleccionado.</h4></td></tr>";
	}

	pedido_procesar()
}

function pedido_procesar(){
	if (mem_detalle.length > 0) {
		let cantidad = mem_detalle.length
		let subtotal = 0;
		for(var i=0; i<mem_detalle.length; i++){
			subtotal = subtotal + parseFloat(mem_detalle[i].importe)
		}
		mem_pedido.subtotal = subtotal
		get_query('[name=inputCantidad]').value = cantidad
		get_query('[name=inputSubtotal]').value = subtotal
	}else{

	}
}

function detalle_eliminar(ind){
	try {
		mem_detalle.splice(ind,1)
		detalle_mostrar()
		not.exito("Aviso : ",'producto eliminado','topRight')
	} catch(e) {
		not.aviso("Aviso : ",'no se pudo completar.','topRight')
		console.log(e)
	}
}

function detalle_editar(ind){

	get_query("[name=editarPrecio]").value = mem_detalle[ind].precio
	get_query("[name=editarCantidad]").value = mem_detalle[ind].cantidad
	get_query("[name=editarImporte]").value = mem_detalle[ind].importe
	get_query("[name=editarDetalle]").value = mem_detalle[ind].detalle
	let frm = get_id('form_producto_editar')
	frm.setAttribute('data-id', ind)
	$('#modal_producto_editar').modal()

}

function pedido_validar(){
	let _error = 0;

	if (get_id('inputDestino').value.length > 0) {
		mem_pedido.destino = get_id('inputDestino').value;
		not.inputValido('#inputDestino')
	}else{
		_error++
		not.inputError('#inputDestino')
	}

	if (get_id('inputFecha').value.length > 0) {
		mem_pedido.fecha = get_id('inputFecha').value;
		not.inputValido('#inputFecha')
	}else{
		_error++
		not.inputError('#inputFecha')
	}

	if (get_query('[name=inputSubtotal]').value.length > 0) {
		mem_pedido.subtotal = get_query('[name=inputSubtotal]').value;
	}else{
		_error++
		not.inputError('[name=inputSubtotal]')
	}

	if (mem_detalle.length > 0) {

	}else{
		_error++
		not.error('Pedido','elije al menos 1 producto')
	}

	return _error
}

function crear(){
	let ruta = srv.url()+'pedido/registrarPresencial'

	$.ajax({
		url : ruta,
		method : 'POST',
		data: {
			pedido : mem_pedido,
			detalle : mem_detalle
		},
		success: function(resp){
			console.log(resp)
		}
	})
}




// `dp_id`, 
// `pedido_id`, 
// `producto_id`, 
// `dp_precio`, 
// `dp_cantidad`, 
// `dp_importe`, 
// `dp_detalle`



// `ped_id`, 
// `ped_fecha`, 
// `ped_subtotal`, 
// `ped_tipo_consumo`, 
// `ped_destino`, 
// `ped_estado`