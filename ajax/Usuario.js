function cadastarUsuario(url, dados, callback,preload) {
    $.ajax({
        url: url,
        type: 'POST',
        data: { 
            login: dados.usuario,
            nome: dados.nome,
            status: dados.status,
            perfil: daods.perfil,
            senha: dados.senha,
            conf_senha: dados.conf_senha
        },
        success: function(data) {
            callback(data);

        },
        beforeSend: function() {
            
        }
    });
}

function listar(id,url){
    $.ajax({
        url: url,
        type: 'POST',
        data: {listar:'listar'},
        success: function(data) {
            $(id).html(data);
        },
        beforeSend: function() {
            
        }
    });
};