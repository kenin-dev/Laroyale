// Registro Pedido

function descicionTipoPedido(tipo){
	let l_destino = document.createElement('label')
	l_destino.setAttribute('class', 'font-weight-bold')
	l_destino.textContent = 'Destino'
	destinoContenedor.innerHTML = ''
	destinoContenedor.appendChild(l_destino)

	switch (tipo) {
		case '2':
			// Presencial
			let i_destino = document.createElement('input')
			i_destino.setAttribute('id', 'pedidoDestino')
			i_destino.setAttribute('class', 'form-control')
			destinoContenedor.appendChild(i_destino)
			break;
		case '1':
			// Delivery
			let s_destino = document.createElement('select')
			s_destino.setAttribute('class','form-control')
			destinoContenedor.appendChild(s_destino)

			for(m in mesasArray){

				let o_mesa = document.createElement('option')
				o_mesa.setAttribute('value', 'Mesa '+mesasArray[m].mes_numero)
				o_mesa.textContent = 'Mesa '+mesasArray[m].mes_numero
				s_destino.appendChild(o_mesa)

			}
			break;
	}
}