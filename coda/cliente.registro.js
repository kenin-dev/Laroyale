

// document.addEventListener('submit', function(e){
// 	if (e.target.matches('#form-registro')) {
// 		e.preventDefault()
// 		let dni  = document.querySelector('[name=inputNumerodoc]')
// 		let feed = document.getElementById('feedDni')
// 		let dataver = new FormData()
// 		let estado = 0
// 		dataver.append('dni',dni.value)


// 		fetch(srv.url()+'cliente/verificarDni',{
// 			body : dataver,
// 			method: 'post'
// 		})
// 		.then(resp =>{
// 			return (resp.ok) ? resp.text() : Promise.reject({ status: resp.status, statusText: statusText() })
// 		})
// 		.then(resp => {

// 			let data = JSON.parse(resp)
// 			console.log(data.codigo)
// 			if (data.codigo === 1) {
// 				dni.classList.remove('is-valid')
// 				feed.classList.remove('valid-feedback')
// 				dni.classList.add('is-invalid')
// 				feed.classList.add('invalid-feedback')
// 				feed.textContent = data.mensaje
// 			}else{
// 				// console.log('nada')
// 				let data_form = new FormData()
// 				data_form.append('dni',dni.value)
// 				data_form.append('Tipodoc',document.querySelector('[name=inputTipodoc]').value)
// 				data_form.append('inputNombres',document.querySelector('[name=inputNombres]').value)
// 				data_form.append('inputPaterno',document.querySelector('[name=inputPaterno]').value)
// 				data_form.append('inputMaterno',document.querySelector('[name=inputMaterno]').value)
// 				data_form.append('inputTelefono',document.querySelector('[name=inputTelefono]').value)
// 				data_form.append('inputDireccion',document.querySelector('[name=inputDireccion]').value)
// 				data_form.append('inputTipocli',document.querySelector('[name=inputTipocli]').value)

// 				fetch(srv.url()+'cliente/registrar_rest',{
// 					body : data_form,
// 					method : 'post'
// 				})
// 				.then(function(resp){
// 					return (resp.ok) ? resp.text() : Promise.reject({ status: resp.status, statusText: statusText() })

// 				})
// 				.then(function(resp){
// 					let regdata = JSON.parse(resp)
// 					console.log(regdata)
// 				})
// 				.catch(function(err){
// 					console.log(err.statusText)
// 				})


// 			}

// 		})	
// 		.catch(function(err){
// 			// e.preventDefault()
// 			console.log(err.statusText)
// 		})
		
// 	}
// }, true)



