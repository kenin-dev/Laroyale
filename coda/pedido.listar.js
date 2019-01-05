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
    }, false)

  }, true)