var inicio=function alerta(){
    // $(".cantidad").keyup(function(e){
    //     if($(this).val()!=''){
    //         if(e.keyCode==13){
    //             var id=$(this).attr('data-id');
    //             var precio=$(this).attr('data-precio');
    //             var cantidad=$(this).val();
    //             $(this).parentsUntil('.producto').find('.subtotal').text('.Subtotal: '+(precio*cantidad));
    //             $.post('modificarDatos.php',{
    //                 Id:id,
    //                 Precio:precio,
    //                 Cantidad:cantidad

    //             },function(e){  
    //                 $("#total").text('Total: '+e);
    //             });
    //         }
    //     }
    // });
    alerta('');
}

$(document).on('ready',inicio);
