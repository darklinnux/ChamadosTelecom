function enviarDados(url, dados, callback) {
    $.ajax({
        url: url,
        type: 'POST',
        data: dados,
        success: function(data) {
            callback(data);

        },
        beforeSend: function() {
            
        }
    });
}

function consultar(url,callback){
    $.ajax({
        url: url,
        success: function(data) {
            callback(data);
        },
        beforeSend: function() {
            
        }
    });
};