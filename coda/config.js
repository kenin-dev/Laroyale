const ENV = 'dev';



const get_id = document.getElementById.bind(document);
const get_query = document.querySelector.bind(document);

class Servidor{

	url(){
		const protocol = (ENV === 'dev') ? location.protocol : '';
		const server   = (ENV === 'dev') ? location.host : '';
		const app      = 'Laroyale'; 
		const url = protocol+'//'+server+'/'+app+'/';
		return url;
	} 
}

class UI{

	LoginWall(){
		const wall = ['uno.jpg','dos.jpg','tres.jpg','cuatro.jpg','cinco.jpg','seis.jpg'];
		var aleatorio = Math.floor((Math.random() * wall.length) + 0)
		var srv = new Servidor();
		var ruta = srv.url()+'template/images/wall/'+wall[aleatorio];

		// console.log(aleatorio);
		document.querySelector('body').setAttribute('background',ruta);
	}
}

class Notificacion{

	exito(titulo, mensaje, posicion){
		iziToast.show({
        title: titulo,
        message: mensaje,
        position: posicion,
        backgroundColor: 'rgb(42, 122, 120)',
        messageColor: '#fff',
        titleColor: 'rgb(236, 249, 178)',
        timeout : 3000,
        icon : 'ti-check',
        iconColor: 'rgb(204, 238, 0)' 
    });
	}

	error(titulo, mensaje, posicion){
		iziToast.show({
        title: titulo,
        message: mensaje,
        position: posicion,
        backgroundColor: '#fd0054',
        messageColor: '#fff',
        titleColor: '#fff',
        timeout : 3000,
        icon : 'ti-close',
        iconColor: '#fff' 
    });
	}

	aviso(titulo, mensaje, posicion){
		iziToast.show({
        title: titulo,
        message: mensaje,
        position: posicion,
        backgroundColor: 'rgb(249,210,25) ',
        messageColor: 'rgb(101,100,95)',
        titleColor: 'rgb(56,54,54)',
        timeout : 3000,
        icon : 'ti-info-alt',
        iconColor: 'rgb(56,54,54)' 
    });
	}

  info(titulo, mensaje, posicion){
    iziToast.show({
        title: titulo,
        message: mensaje,
        position: posicion,
        backgroundColor: '#97de95',
        messageColor: '#606470',
        titleColor: '#606470',
        timeout : 3000,
        icon : 'fas fa-exclamation-circle',
        iconColor: '#606470' 
    });
  }

}

document.addEventListener('DOMContentLoaded', function(){
    $('#dtable').DataTable({
        dom: 'Bfrtip',
        buttons: [
           'csv', 'excel', 'pdf', 'print'
        ],
        "language": {
        "lengthMenu": "Mostrar _MENU_ registros por pagina",
        "zeroRecords": "No se encontro nada - Perdon",
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "infoEmpty": "Sin registros disponibles",
        "infoFiltered": "(filtrando _MAX_ total records)"
        }
    });
}, false);


var srv = new Servidor();
var ui = new UI();
var not = new Notificacion();