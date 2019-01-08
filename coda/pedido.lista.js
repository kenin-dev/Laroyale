document.addEventListener('DOMContentLoaded', function(e){
    let tl = new TableLibrary('Pedidos')
    tl.inicializar()

    document.addEventListener('click', function(e){

      if(e.target.matches('#mesa-eliminar')){
        let mesa = e.target.dataset.mesa
        let resp = confirm('Eliminar a '+mesa+'?')
        if (resp) {
          console.log('enviado para eliminar: '+mesa)
        }else{
          e.preventDefault()
        }
      }

      if (e.target.matches('.pen_anular')) {
        // e.preventDefault()
        // bk.delete(e.target.dataset.serie,'Anular pedido?',e)
        let resp = confirm('Anular '+e.target.dataset.serie+'?')
        if (resp==true) {
          console.log('enviado para eliminar: '+e.target.datseet.serie)
        }else{
          e.preventDefault()
        }
      }

    }, false)

  }, true)