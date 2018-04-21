$('#seen-button').click(function(){
    $.ajax({
        url: '/api/v1/Notifications/seen-all',
    }).done(function (response) {
        if (response.result == 0) {
        } else {
            $("tr.text-success").attr('class','');    
        }
    }).fail(function (jqXHR) { 
        swalError('' + jqXHR.status,'' +jqXHR.text);
    });
});
    
