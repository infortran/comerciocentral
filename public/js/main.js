/*price range*/

if ($.fn.slider) {
    $('#sl2').slider();

}

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {
    //TOOLTIP & POPOVER BOOTSTRAP
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    //RANGO DE PRECIOS ASIDE LEFT
    $('#sl2').slider().on('slideStop', function(e){
        $('.min-precio').html('$ '+formatNumber(e.value[0]));
        $('.max-precio').html('$ '+formatNumber(e.value[1]));
        rangoPrecios(e.value[0], e.value[1]);
    });

    //FORMULARIO CONTACTO
    $('.icon-cont').click(function(){
        $('#error-motivo').html('');
       var motivo = $(this).data('motivo');
       $('#motivo-'+motivo).prop('checked', true);
       if(motivo == 'consulta'){
           $('.sugerencia').removeClass('sugerencia-active');
           $('.reclamo').removeClass('reclamo-active');
       }
       if(motivo == 'sugerencia'){
           $('.consulta').removeClass('consulta-active');
           $('.reclamo').removeClass('reclamo-active');
       }

       if(motivo == 'reclamo'){
           $('.sugerencia').removeClass('sugerencia-active');
           $('.consulta').removeClass('consulta-active');
       }

       $(this).addClass(motivo+'-active');
    });

    //FUNCION ENVIAR MENSAJE POR AJAX
    $('#form-enviar-mensaje-ajax').submit(function(e){
        e.preventDefault();
        enviarMensajeAjax();
    });
    contactoErrorsReset();
    $(document).on('click','#rc-anchor-container',function(){
        $('#error-recaptcha').html('');
    });

    //SELECTOR IMAGEN DEL USUARIO
    $("#input-img-user").change(function(){
        var selector = $('#img-user');
        readURL(this, selector);
    });

    //SELECTOR IMAGEN VOUCHER DEPOSITO (funcion se debe eliminar)
    $("#input-img-voucher").change(function(){
        var selector = $('#img-voucher');
        readURL(this, selector);
    });



    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
    //resetColorStar();
    //ratingStars();

    //BOTON ADD CART WRAPPER
    $('.btn-submit-add-cart').click(function(){
        var id = $(this).data('id');
        var tiendaId = $('meta[name="tienda-id"]').attr('content');
        //alert(" " + tiendaId);
        addToCartFromAjax(id, tiendaId);
    });


    $('.btn-submit-remove-on-cart').click(function(){
        var id = $(this).data('id');
        var tiendaId = $('meta[name="tienda-id"]').attr('content');
        removeOnCartFromAjax(id, tiendaId);
    });

    $('.btn-submit-reset-on-cart').click(function(){
        var id = $(this).data('id');
        var tiendaId = $('meta[name="tienda-id"]').attr('content');
        resetOnCartFromAjax(id, tiendaId);
    });

    //SELECT CARRITO ITEM
    $(document).on('change','.select-qty-item-cart',function(){
       var id = $(this).data('id');
       var cant = $(this).val();
       var tiendaId = $('meta[name="tienda-id"]').attr('content');
       if(cant > 0 && cant < 10){
           addToCartByQty(id, cant, tiendaId);
       }else{
           alert('Ha sobrepasado el limite de stock');
        }

    });

    $('#btn-switch-cliente').click(function(){
        switchCliente();
    });

    /****************************
     * STAR RATING FUNCTION
     * ******************/
    $('#star-rating-voto').barrating({
        theme: 'bootstrap-stars',
        onSelect: function(value, text, event){
            votarPorNoticia($('#star-rating-voto').data('post'), value);
        }
    });

    /*********************
     * Comentarios
     ******************/

    $('.btn-editar-comentario-producto').click(function(e){
        e.preventDefault();
        var comentario = $(this).data('comentario');
        var comentarioCont = $('#comentario-producto-cont-'+ comentario);

        $('#input-editar-comentario-producto-'+comentario).show().val(comentarioCont.html());
        $('#btn-submit-comentario-producto-'+comentario).show();
        comentarioCont.hide();
        $(this).hide();
    });


});

function votarPorNoticia(noticia, voto){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/votar_noticia/'+noticia+'/'+voto,
        contentType:false,
        processData:false,
        cache:false,
        success:function(data){
            if(data){
                showSnackBar('Gracias por darnos tu opinion', 1500);
                setTimeout(function(){
                    location.reload();
                },1500);
            }
        },error:function(x,y,z){
            alert(y);
            //location.reload();
        }
    });
}

function enviarMensajeAjax(){
    var fade = 800;
    var fadeout = 400;
    var data = new FormData();
    var motivo = $('.motivo-contacto:checked').val();
    //alert(motivo === undefined ? null : motivo)
    data.append('motivo', motivo === undefined ? '' : motivo);
    data.append('asunto', $('#asunto-contacto').val());
    data.append('mensaje',$('#mensaje-contacto').val());
    data.append('orden',$('#orden-contacto').val());
    data.append('g-recaptcha-response',grecaptcha.getResponse());
    data.append('name',$('#name-contacto').val());
    data.append('lastname',$('#lastname-contacto').val());
    data.append('email',$('#email-contacto').val());
    data.append('telefono',$('#telefono-contacto').val());
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       url:'/contacto',
        method:'POST',
        data:data,
        processData:false,
        contentType:false,
        cache:false,
        dataType:'json',
        beforeSend:function(){

            $('#btn-enviar-mensaje').addClass('active');

        },
        success:function(json){

            setTimeout(function(){
                if($.isEmptyObject(json.error)){
                    $('#btn-enviar-mensaje').addClass('success');
                    $('#mensaje-success-icon').show();
                    $('#mensaje-text-btn').hide();
                    $('#mensaje-default-icon').hide();
                    setTimeout(function(){
                        $('#btn-enviar-mensaje').removeClass('active success');
                        $('#mensaje-success-icon').hide();
                        $('#mensaje-text-btn').show();
                        $('#mensaje-default-icon').show();
                        contactoReset();
                    },3000);
                    setTimeout(function(){
                        $('#modal-mensaje-enviado').modal('show');
                    },3500);
                    //SUCCESS
                }else{
                    $('#btn-enviar-mensaje').addClass('error');
                    $('#mensaje-error-icon').show();
                    $('#mensaje-text-btn').hide();
                    $('#mensaje-default-icon').hide();
                    setTimeout(function(){
                        $('#btn-enviar-mensaje').removeClass('active error');
                        $('#mensaje-error-icon').hide();
                        $('#mensaje-text-btn').show();
                        $('#mensaje-default-icon').show();
                    },3000)
                    //alert('mostrando errores');
                    //mostrar errores
                    var errorMotivo = json.error.motivo ? 'Debes seleccionar un motivo para tu mensaje' : '';
                    $('#error-motivo').html(errorMotivo);
                    $('#error-name').html(json.error.name);
                    $('#error-lastname').html(json.error.lastname);
                    $('#error-email').html(json.error.email);
                    $('#error-telefono').html(json.error.telefono);
                    $('#error-asunto').html(json.error.asunto);
                    $('#error-mensaje').html(json.error.asunto);
                    $('#error-recaptcha').html(json.error['g-recaptcha-response']);
                    if(json.error['g-recaptcha-response']){
                        setTimeout(function(){$('#error-recaptcha').html('')},3000);
                    }
                }
            },1500);

            console.log(json.error);
        },error:function(x,y,z){
            console.log(x.responseText);
            alert('error');
        }
    });
}

function contactoErrorsReset(){
    $('#name-contacto').focus(function(){$('#error-name').html('')});
    $('#lastname-contacto').focus(function(){$('#error-lastname').html('')});
    $('#email-contacto').focus(function(){$('#error-email').html('')});
    $('#telefono-contacto').focus(function(){$('#error-telefono').html('')});
    $('#asunto-contacto').focus(function(){$('#error-asunto').html('')});
    $('#mensaje-contacto').focus(function(){$('#error-mensaje').html('')});

}

function contactoReset(){
    $('#name-contacto').val('');
    $('#lastname-contacto').val('');
    $('#email-contacto').val('');
    $('#telefono-contacto').val('');
    $('#asunto-contacto').val('');
    $('#mensaje-contacto').val('');
}

function switchCliente(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'switch_cliente',
        type:'POST',
        contentType:false,
        processData:false,
        cache:false,
        beforeSend:function(){
          $('#btn-switch-cliente >i').removeClass('fa-users').addClass('fa-circle-notch fa-spin');

        },
        success:function(data){
            if(data === 'block'){
                setTimeout(function(){
                    $('#modal-block-cliente').modal('show');
                    $('#btn-switch-cliente >i').addClass('fa-check-circle').removeClass('fa-circle-notch fa-spin');

                },800);
                return;
            }
            if(data === 'new'){
                setTimeout(function(){
                    showSnackBar('Bienvenido como nuevo cliente de esta tienda', 1500);
                    $('#btn-switch-cliente').addClass('btn-comerciocentral').removeClass('btn-cliente');
                    $('#btn-switch-cliente >i').addClass('fa-check-circle').removeClass('fa-circle-notch fa-spin');
                    $('.text-btn-cliente').html('BRAVO!! Eres un nuevo cliente');
                },800);

                setTimeout(function(){
                    $('.text-btn-cliente').html('Soy cliente');
                },3000);
            }else{
                if(data === 'on'){
                    setTimeout(function(){
                        showSnackBar('Bienvenido nuevamente a esta tienda como cliente', 1500);
                        $('#btn-switch-cliente').addClass('btn-comerciocentral').removeClass('btn-cliente');
                        $('#btn-switch-cliente >i').addClass('fa-check-circle').removeClass('fa-circle-notch fa-spin');
                        $('.text-btn-cliente').html('BIENVENIDO OTRA VEZ!!');
                    },800);

                    setTimeout(function(){
                        $('.text-btn-cliente').html('Soy cliente');
                    },3000);
                }else{
                    setTimeout(function(){
                        showSnackBar('Has dejado de ser cliente de esta tienda', 1500);
                        $('#btn-switch-cliente').removeClass('btn-comerciocentral').addClass('btn-cliente');
                        $('#btn-switch-cliente >i').addClass('fa-users').removeClass('fa-circle-notch fa-spin');
                        $('.text-btn-cliente').html('Que pena, te extrañaremos...');
                    },800);

                    setTimeout(function(){
                        $('.text-btn-cliente').html('Hazte Cliente');
                    },3000);
                }
            }

        },
        error:function(x,y,z){
            $('#btn-switch-cliente >i').addClass('fa-users').removeClass('fa-circle-notch fa-spin');
            alert('error');
        }
    });

}

function showSnackBar(mensaje, duracion){
    $('#snackbar').addClass('show-snackbar').html(mensaje);
    setTimeout(function(){
        $('#snackbar').removeClass('show-snackbar');
    },duracion);
}

function rangoPrecios(min, max){
    var data = new FormData();
    data.append('min', min);
    data.append('max', max);
    data.append('tienda', $('meta[name="tienda-id"]').attr('content'));

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       type:'POST',
       url:'rangoprecios',
       data:data,
        contentType:false,
        processData:false,
        cache:false,
        beforeSend:function(){
            $('.loading-productos').fadeIn(500);
            //$('.prod-container').html('');
        },
       success:function(html){
           $('.loading-productos').fadeOut(100);
           $('.prod-container').html('');
           $('.prod-container').html(html);
       } ,
        error:function(xhr, ajaxOptions, thrownError){
            $('.loading-productos').fadeOut(500);
            //location.reload();
        }
    });
}


//ADD CART BUTTON FN
function addToCartFromAjax(id, tienda) {
    var data = new FormData();
    data.append('id', id);
    data.append('tienda', tienda);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:data,
        url:'/add_to_cart',
        method:'POST',
        processData:false,
        contentType:false,
        cache:false,
        dataType:'json',
        beforeSend:function(){
            $('#btn-cart-' + id).addClass("loading-cart");
            $('#btn-cart-2-' + id).addClass("loading-cart");
            $('.btn-default').prop('disabled', true);
        },
        success:function(data){
            addCantidadProducto(data.id_producto, data.cantidad_producto);
            setTimeout(function(){
                $('.badge-carrito').html(data.cantidad_total);
                $('.checkout-link').removeClass('display-none-imp');
                $('.precio-total-float p').html('$ '+data.total_mas_envio);
                $('#remove-cart-wrapper-'+id).removeClass('d-none-important');
                //DESACTIVAR TODOS LOS BOTONES ADD-CART
                $('.btn-default').prop('disabled', false);
                disableRemoveBtn(data.cantidad_producto);
                //Agregar clase SUCCESS para animacion de btn
                $('#btn-cart-' + data.id_producto).addClass("success-add-cart");
                $('#btn-cart-2-' + data.id_producto).addClass("success-add-cart");

                //MOSTRAR el check y ocultar texto
                $('#check-' + data.id_producto).fadeIn(2000);
                $('#icon-cart-' + data.id_producto).hide();
                $('#btn-text-cart-' + data.id_producto).hide();
                //lo mismo en overlay
                $('#check1-' + data.id_producto).fadeIn(2000);
                $('#icon-cart1-' + data.id_producto).hide();
                $('#btn-text-cart1-' + data.id_producto).hide();
                //Mostrar el SNACKBAR
                showSnackBar('Producto agregado al carrito de compras', 1500);
                }, 500);

            setTimeout(function(){

                //Remover el LOADING y el SUCCESS
                $('#btn-cart-2-' + data.id_producto).removeClass("loading-cart")
                    .removeClass("success-add-cart");
                $('#btn-cart-' + data.id_producto).removeClass("loading-cart")
                    .removeClass("success-add-cart");

                //OCULTAR check y MOSTRAR texto
                $('#check-' + data.id_producto).hide();
                $('#icon-cart-' + data.id_producto).show();
                $('#btn-text-cart-' + data.id_producto).show();
                //overlay
                $('#check1-' + data.id_producto).hide();
                $('#icon-cart1-' + data.id_producto).show();
                $('#btn-text-cart1-' + data.id_producto).show();

            },1500);
        },
        error:function(){
            location.reload();
        }
    });
}

//REMOVE CART BUTTON FN
function removeOnCartFromAjax(id, tienda) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/remove_on_cart/' + id + '/'+ tienda,
        processData:false,
        contentType:false,
        cache:false,
        dataType:'json',
        beforeSend:function(){
            $('.btn-default').prop('disabled', true);
        },
        success:function(data){
            data.cantidad_total > 0 ? $('.badge-carrito').html(data.cantidad_total): $('.badge-carrito').html('');
            data.cantidad_total > 0 ? $('.checkout-link').removeClass('display-none-imp'): $('.checkout-link').addClass('display-none-imp');
            data.cantidad_total > 0 ? $('.precio-total-float p').html('$ '+data.total_mas_envio) : $('.precio-total-float p').html('vacio');
            data.cantidad_producto > 0 ? $('#remove-cart-wrapper-'+id).removeClass('d-none-important'):$('#remove-cart-wrapper-'+id).addClass('d-none-important');
            addCantidadProducto(data.id_producto, data.cantidad_producto);

            $('#snackbar-remove').addClass('show-snackbar');

            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){
                $('#snackbar-remove').removeClass('show-snackbar');
                //snackbar.className = snackbar.className.replace("show-snackbar", "");
                $('.btn-default').prop('disabled', false);
                disableRemoveBtn(data.cantidad_producto);
            }, 1500);
        },
        error:function(xhr, ajaxOptions, thrownError){
            console.log('Mostrando el error de ajax');
            console.log(xhr.responseText);
            //location.reload();
        }
    });
}

//ADD CART BY QUANTITY
function addToCartByQty(idProd, cant, tienda){
    var data = new FormData();
    data.append('id', idProd);
    data.append('cantidad', cant);
    data.append('tienda', tienda);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:data,
        url:'/add_cart_qty',
        type:'POST',
        contentType:false,
        processData:false,
        cache:false,
        dataType:'json',
        beforeSend:function(){
            $('.loading-item-cart').fadeIn(500);
            $('.loading-aside-cart').fadeIn(500);
        },
        success:function(json){
            setTimeout(function(){
                if(json.envio){
                    $('#panel-envio').fadeIn(500);
                    $('#panel-sin-envio').fadeOut(500);
                }else{
                    $('#panel-sin-envio').fadeIn(500);
                    $('#panel-envio').fadeOut(500);
                }
                if(json.precio_envio == 0){
                    $('#precio-envio').html('<i style="color:green">GRATIS</i>');
                }else{
                    $('#precio-envio').html("$ " + json.precio_envio);
                }
                json.cantidad_total > 0 ? $('.badge-carrito').html(json.cantidad_total) : $('.badge-carrito').html('');
                json.cantidad_total > 0 ? $('.checkout-link').removeClass('display-none-imp'): $('.checkout-link').addClass('display-none-imp');
                $('.loading-item-cart').fadeOut(500);
                $('.loading-aside-cart').fadeOut(500);
                $('#cart-cantidad-total').html(json.cantidad_total);
                $('#cart-subtotal').html('$ ' + json.precio_total);
                $('#total-mas-envio').html('$ ' + json.total_mas_envio);
                $('#total-producto-' + json.id_producto).html('$ ' + json.total_producto);
                $('#descripcion-envio').html(json.descripcion_envio);
                $('.precio-total-float p').html('$ '+json.total_mas_envio);
            },500);
        },
        error:function (xhr, ajaxOptions, thrownError) {
            console.log('Mostrando el error de ajax');
            console.log(xhr.responseText);
            location.reload();
        }
    });
}

function resetOnCartFromAjax(id, tienda) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/reset_on_cart/' + id + '/' + tienda,
        processData:false,
        contentType:false,
        cache:false,
        dataType:'json',
        beforeSend:function(){
            $('.loading-item-cart').fadeIn(500);
            $('.loading-aside-cart').fadeIn(500);
        },
        success:function(json){
            setTimeout(function(){
                //alert(json.cantidad_total);
                $('#cart_items').html(json.html);
                json.cantidad_total > 0 ? $('.badge-carrito').html(json.cantidad_total): $('.badge-carrito').html('');
                json.cantidad_total > 0 ? $('.checkout-link').removeClass('display-none-imp'): $('.checkout-link').addClass('display-none-imp');
                json.cantidad_total > 0 ? $('.precio-total-float p').html('$ '+data.total_mas_envio) : $('.precio-total-float p').html('vacio');
            },500);
        },
        error:function (xhr, ajaxOptions, thrownError) {
            console.log('Mostrando el error de ajax');
            console.log(xhr.responseText);
            //location.reload();
        }
    });
}

function addCantidadProducto(id, cantidad){
    $('#input-cantidad-producto-' + id).val(cantidad);
}
//FUNCION PARA MOSTRAR FOTO EN LOS INPUTS FILE IMG
function readURL(input, selector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(selector).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function disableRemoveBtn(count){
    if(count <= 0){
        $('.btn-submit-remove-on-cart').prop('disabled', true);
    }else{
        $('.btn-submit-remove-on-cart').prop('disabled', false);
    }
}


function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
}
