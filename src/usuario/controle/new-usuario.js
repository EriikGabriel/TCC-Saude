$(document).ready(function(){
    $('.btn-new').click(function(e){
        e.preventDeafult()

        $('.modal-title').empty()
        $('.modal-body').empty()

        $('.modal-title').append('<h4 class="text-danger">Novo Usuário</h4>')

        $('.modal-body').load('src/usuario/visao/form-usuario.html')

        $('.btn-save').attr('data-operetion', 'insert')

        $('model-tipo-usuario').modal('show')

        $('body').append('<script class="src/usuario/controle/save-usuario.js"></script>')

    })
})