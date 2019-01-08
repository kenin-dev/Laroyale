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

    fecha(){
        var d = new Date();
        var year  = d.getFullYear();
        var fake_m = d.getMonth() + 1;
        var month = ( fake_m > 9 ) ? fake_m : '0'+fake_m;
        var day   = (d.getDate()>9) ? d.getDate() : '0'+d.getDate();
        return year+'-'+month+'-'+day;
        // console.log("In: "+year+'-'+month+'-'+day);
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

    Imprimir(cont){
        // try {
        //     var content  = document.getElementById(cont).innerHTML
        //     var mywindow = window.open('','Imprimir','height=600,width=800')

        //     mywindow.document.write('<html><head><title>Print</title></head>')
        //     mywindow.document.write('<body>')
        //     mywindow.document.write(content)
        //     mywindow.document.write('</body>')

        //     mywindow.document.close()
        //     mywindow.focus()
        //     mywindow.print()
        //     mywindow.close()

        //     return true
        // } catch(e) {
        //     return e.message
        //     console.log(e);
        // } 

        // var contenido= document.getElementById(cont).innerHTML;
        // var contenidoOriginal= document.body.innerHTML;

        // document.body.innerHTML = contenido;
        // window.print();
        // document.body.innerHTML = contenidoOriginal

    }
}

class Notificacion{

	exito(titulo, mensaje, posicion = 'topCenter'){
		iziToast.show({
            title: titulo,
            message: mensaje,
            position: posicion,
            backgroundColor: '#008374',
            messageColor: '#fff',
            titleColor: 'rgb(236, 249, 178)',
            timeout : 4000,
            icon : 'ti-check',
            iconColor: 'rgb(204, 238, 0)' 
        });
	}

	error(titulo, mensaje, posicion = 'topCenter'){
		iziToast.show({
            title: titulo,
            message: mensaje,
            position: posicion,
            backgroundColor: '#FD5C63',
            messageColor: '#fff',
            titleColor: '#fff',
            timeout : 4000,
            icon : 'ti-close',
            iconColor: '#fff' 
        });
	}

	aviso(titulo, mensaje, posicion = 'topCenter'){
		iziToast.show({
            title: titulo,
            message: mensaje,
            position: posicion,
            backgroundColor: '#FCC70A',
            messageColor: '#35495E',
            titleColor: '#35495E',
            timeout : 4000,
            icon : 'ti-info-alt',
            iconColor: '#35495E' 
        });
	}

    info(titulo, mensaje, posicion = 'topCenter'){
        iziToast.show({
            title: titulo,
            message: mensaje,
            position: posicion,
            backgroundColor: '#97de95',
            messageColor: '#606470',
            titleColor: '#606470',
            timeout : 4000,
            icon : 'fas fa-exclamation-circle',
            iconColor: '#606470' 
        });
    }

    wait(titulo, mensaje, posicion = 'topCenter'){
        iziToast.show({
            title: titulo,
            message: mensaje,
            position: posicion,
            backgroundColor: '#7B8994',
            messageColor: '#fff',
            titleColor: '#fff',
            timeout : 5000,
            icon : 'ti-rss-alt',
            iconColor: '#fff' 
        });
    }

    modal_cargando(){
        Swal({
          title: 'Registro de pedido!',
          text: 'Procesando....',
          closeOnClickOutside: false,
          // imageUrl: 'https://unsplash.it/400/200',
          // imageWidth: 400,
          // imageHeight: 200,
          // imageAlt: 'Custom image',
          animation: false
        })
    }

    inputError(input){
        document.querySelector(input).classList.remove('is-valid');
        document.querySelector(input).classList.add('is-invalid');
    }

    inputValido(input){
        document.querySelector(input).classList.remove('is-invalid');  
        document.querySelector(input).classList.add('is-valid');
    }

}

class TableLibrary {
    constructor(entidad = 'informacion'){
        this.entidad = entidad
        this.titulo  = 'Laroyale - '+entidad 
    }

    inicializar(){
        $('#dtable').DataTable({
            dom: 'Bfrtip',
            buttons: [
               { extend: 'excelHtml5',title: this.titulo },
               { extend: 'pdfHtml5',title: this.titulo }
            ],
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron datos",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros disponibles",
            "infoFiltered": "(filtrando _MAX_ total records)"
            }
        }); 

         $('#dtable2').DataTable({
            dom: 'Bfrtip',
            buttons: [
               { extend: 'excelHtml5',title: this.titulo },
               { extend: 'pdfHtml5',title: this.titulo }
            ],
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron datos",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros disponibles",
            "infoFiltered": "(filtrando _MAX_ total records)"
            }
        });

         $('#dtable3').DataTable({
            dom: 'Bfrtip',
            buttons: [
               { extend: 'excelHtml5',title: this.titulo },
               { extend: 'pdfHtml5',title: this.titulo }
            ],
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron datos",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "Sin registros disponibles",
            "infoFiltered": "(filtrando _MAX_ total records)"
            }
        }); 
    }

}

class Backend{

    delete(titulo,mensaje,ev){
        let resp = false
        Swal({
          title: titulo,
          text:  mensaje,
          type:  tipo,
          showCancelButton: true,
          confirmButtonColor: '#1874c3',
          cancelButtonColor: '#ff5959',
          confirmButtonText: 'Si',
          cancelButtonText: 'No'
        }).then((res) => {
          // console.log(res)
          if (res.value) {
            Swal(
              'Genia!',
              'Pedido anulado.',
              'success'
            )
          }else{
            ev.preventDefault()
          }

        })


    }


}
// document.addEventListener('DOMContentLoaded', function(){
//     $('#dtable').DataTable({
//         dom: 'Bfrtip',
//         buttons: [
//             {
//                 extend: 'excelHtml5',
//                 title: 'Laroyale - Excel'
//             },
//             {
//                 extend: 'pdfHtml5',
//                 title: 'Laroyale - PDF '
//             }
//         ],
//         "language": {
//         "lengthMenu": "Mostrar _MENU_ registros por pagina",
//         "zeroRecords": "No se encontraron datos",
//         "info": "Mostrando pagina _PAGE_ de _PAGES_",
//         "infoEmpty": "Sin registros disponibles",
//         "infoFiltered": "(filtrando _MAX_ total records)"
//         }
//     });
// }, false);


const srv = new Servidor();
const ui  = new UI();
const not = new Notificacion();
const bk  = new Backend() 