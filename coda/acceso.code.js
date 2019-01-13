const b_enviar = document.getElementById('b-enviar')

ui.LoginWall()

document.addEventListener('DOMContentLoaded',function(){

	b_enviar.disabled = false

	document.addEventListener('submit', function(e){

		if (e.target.matches('#acceso_form')) {
			e.preventDefault()
			let us = document.querySelector('[name=inputUsername]').value
			let ps = document.querySelector('[name=inputPass]').value

			if (validar(us,ps)) {
				// console.log('correcto')
				var form = new FormData()
				form.append('usuario',us)
				form.append('clave',ps)
				verificar(form)
			}else{
				// console.log('error')
				not.error('Error','Datos incompletos','topCenter')
			}

		}

	}, false)

},true)


function validar(us,ps){
	let res = true
	if (us.length == 0 || ps.length == 0) {
		res = false
	}

	return res
}

function verificar(data){
	fetch(srv.url()+'autenticacion/login',{
		body : data,
		method: 'post'
	})

	.then(function(resp){
		return resp.json()
	})
	.then(function(resp){
		// console.log(resp)
		switch(resp.estado){
			case 0:
				not.aviso('Oops',resp.mensaje,'topCenter')
				break;
			case 1:
				not.exito('Genial!',resp.mensaje,'topCenter')
				setTimeout(function(){
					window.location.reload()
				}, 1000)
				break;
		}	
	})
	.catch(function(err){
		console.log(err)
	})
}