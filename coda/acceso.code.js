ui.LoginWall();

// not.exito("hola","que cuentas?","topCenter");

get_id('acceso_form').addEventListener('submit', function(e){
	e.preventDefault();
	if (get_query('[name=inputUsername]').value.length > 0 && get_query('[name=inputPass]').value.length > 0) {
		var data = new FormData();
		data.append("username",get_query('[name=inputUsername]').value);
		data.append("pass",get_query('[name=inputPass]').value);
		send(data);
		// console.log('here')
	}else{
		
		not.aviso("Aviso","Datos incompletos","topRight");
	}

}, false);



function send(data){

	fetch(srv.url()+'autenticacion/login',{
		body : data,
		method : 'post'
	})
	.then(resp => {
		// console.log(resp.text())
		console.log(resp)
		return (resp.ok) 
		? resp.text() 
		: Promise.reject({ status: resp.status, statusText: statusText() })
	})
	.then(resp => {
		var data = JSON.parse(resp)
		console.log(data)

		if(data.estado === 1){
			not.exito("Acceso",data.mensaje,'topCenter');
			setTimeout(function(){
				window.location = srv.url()+'Inicio'
			},1100)
			
		}else{
			not.error("Acceso",data.mensaje,'topCenter');
		}
	})
	.catch(function(err){
		console.log(`${err.statusText}`)
	});

}