/**
 * Comercio Central
 * User javascript file
 * Created by Freddy Perez Pacheco on 19-10-20.
 */

$(document).ready(function(){
    //IMG USER
    $('#input-img-user').change(function(){
        if(this.files[0].size > 2097152){
            alert("La imagen supera el límite de tamaño (2MB)");
            this.value = "";
        }else{
            var selector = $('#img-user');
            readURL(this, selector);
            $('#btn-img-user').fadeIn(1000);
        }
    });

    $('#btn-img-user').click(function(){
       storeImg();
    });

    $('.fluid-logout').resize(function(){
        alert('resized');
       if(this.width() < 100){
           this.html('<i class="fa fa-power-off"></i>')
       }else{
           this.html('Cerrar Sesión')
       }
    });
});

/**************************************
 *      Funciones Principales*/


function storeImg(){
    var data = new FormData();
    data.append('img', $('#input-img-user')[0].files[0]);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'user/storeimg',
        method:'POST',
        data:data,
        dataType:'json',
        processData:false,
        contentType:false,
        cache:false,
        beforeSend:function(){
          $('#btn-img-user i').addClass('fa-spinner fa-spin').removeClass('fa-save');
        },
        success:function(json){
            setTimeout(function(){
                $('#btn-img-user i').removeClass('fa-spinner fa-spin').addClass('fa-check');
                if($.isEmptyObject(json.error)){

                }else{

                }
                console.log(json);
            },2000);
            setTimeout(function(){
                $('#btn-img-user i').removeClass('fa-check').addClass('fa-save');
            },3000);
        },
        error:function(x,y,z){
            $('#btn-img-user i').removeClass('fa-spinner fa-spin').addClass('fa-save');
            console.log(x.responseText);
            alert('error en ajax');
        }
    });
}

function storeUserData(){

}

function storeDir(){

}

function changePass(){

}

function deleteAccount(){

}
 /**      Fin fn principales
 * *********************************/


function readURL(input, selector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(selector).attr('src', e.target.result);
            $(selector).css({
                'width':'120px',
                'height':'120px'
            });
        }
        reader.readAsDataURL(input.files[0]);
    }
}
