window.addEventListener('load', function(){
    $('#search').on('input', getDishesByNameAndFilters);
});

var getDishesByNameAndFilters = function(){
    let request_data = {'name': $('#search').val() };

    // массив request_data готов для отправки серверу
    console.log(request_data);
    
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        dataType: 'html',
        data: request_data,  // отправляем массив в php
        success: function(response_html){
            //console.log('fff');
          $("#display").html(response_html);
        },
        error: function(jqXHR, status, msg){
            console.log(jqXHR); console.log(msg+' '+status);
        }
    });
};