/*price range*/

if ($.fn.slider) {
    $('#sl2').slider();

}

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('#sl2').slider().on('slideStop', function(e){
        $('.min-precio').html('$ '+formatNumber(e.value[0]));
        $('.max-precio').html('$ '+formatNumber(e.value[1]));
        rangoPrecios(e.value[0], e.value[1]);
    });

    $('.icon-cont').click(function(){
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
    $("#input-img-user").change(function(){
        var selector = $('#img-user');
        readURL(this, selector);
    });

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

    /*$('.btn-plus-cart').click(function(){
        var id = $(this).data('id');
        $('#input-item-cart-' + id).val(parseInt($('#input-item-cart-' + id).val()) + 1).change();
    });*/

    $(document).on('click', '.btn-plus-cart', function () {
        var id = $(this).data('id');
        var value = $('#input-item-cart-' + id).val();
        if(value < 10){
            $('#input-item-cart-' + id).val(parseInt($('#input-item-cart-' + id).val()) + 1).change();
        }else{
            alert('Ha sobrepasado el limite de stock');
        }
    });

    $(document).on('click','.btn-minus-cart',function(){
        var id = $(this).data('id');
        var value = $('#input-item-cart-' + id).val();
        if(value > 1){
            $('#input-item-cart-' + id).val(parseInt(value) - 1).change();
        }
    });

    $(document).on('change','.input-item-cart',function(){
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
});

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
            if(data === 'new'){
                showSnackBar('Bienvenido como nuevo cliente de esta tienda', 1500);
                $('#btn-switch-cliente').addClass('btn-comerciocentral').removeClass('btn-cliente');
                $('#btn-switch-cliente >i').addClass('fa-check-circle').removeClass('fa-circle-notch fa-spin');
            }else{
                if(data === 'on'){
                    showSnackBar('Bienvenido nuevamente a esta tienda como cliente', 1500);
                    $('#btn-switch-cliente >i').addClass('fa-check-circle').removeClass('fa-circle-notch fa-spin');
                }else{
                    showSnackBar('Has dejado de ser cliente de esta tienda', 1500);
                    $('#btn-switch-cliente >i').addClass('fa-users').removeClass('fa-circle-notch fa-spin');
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
            location.reload();
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
                $('#cart_items').html(json.html);
                json.cantidad_total > 0 ? $('.badge-carrito').html(json.cantidad_total): $('#badge-carrito').html('');
                json.cantidad_total > 0 ? $('.checkout-link').removeClass('display-none-imp'): $('.checkout-link').addClass('display-none-imp');

            },500);
        },
        error:function (xhr, ajaxOptions, thrownError) {
            console.log('Mostrando el error de ajax');
            console.log(xhr.responseText);
            location.reload();
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
