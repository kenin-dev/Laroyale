document.addEventListener('DOMContentLoaded', function(){
	$('#dtable').DataTable({
	    "language": {
	    "lengthMenu": "Mostrar _MENU_ Registros por pagina",
	    "zeroRecords": "No se encontro nada - Perdon",
	    "info": "Mostrando pagina _PAGE_ de _PAGES_",
	    "infoEmpty": "Sin registros disponibles",
	    "infoFiltered": "(filtrando _MAX_ total records)"
	    }
	});
}, false);