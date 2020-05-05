/*price range*/

if ($.fn.slider) {
    $('#sl2').slider();
}

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {

    $("#input-img-user").change(function(){
        var selector = $('#img-user');
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
        addToCartFromAjax(id);
    });

    $('.btn-submit-remove-on-cart').click(function(){
        var id = $(this).data('id');
        removeOnCartFromAjax(id);
    });

    $('.btn-submit-reset-on-cart').click(function(){
        var id = $(this).data('id');
        resetOnCartFromAjax(id);
    });

    $('.btn-plus-cart').click(function(){
        var id = $(this).data('id');
        $('#input-item-cart-' + id).val(parseInt($('#input-item-cart-' + id).val()) + 1).change();
    });

    $('.btn-minus-cart').click(function(){
        var id = $(this).data('id');
        var value = $('#input-item-cart-' + id).val();
        if(value > 1){
            $('#input-item-cart-' + id).val(parseInt(value) - 1).change();
        }
    });

    $('.reset-item-cart').click(function(){
        var id = $(this).data('id');

    });

    $('.input-item-cart').change(function(){
       var id = $(this).data('id');
       var cant = $(this).val();
       if(cant > 0){
           addToCartByQty(id, cant);
       }

    });

});
/*var ratedIndex = -1;

function ratingStars(){
    $('.fa-star').mouseover(function(){
        resetColorStar();
        var currentIndex = parseInt($(this).data('index'));
        for(var i = 0; i <= currentIndex; i++)
            $('.fa-star:eq('+i+')').css('color', '#ff621d');
    });
    $('.fa-star').mouseleave(function(){
        resetColorStar();
        if(ratedIndex =! -1)
            for(var i = 0; i <= ratedIndex; i++)
                $('.fa-star:eq('+i+')').css('color', '#ff621d');

    });
}

function resetColorStar() {
    $('.fa-star').css('color', '#afafaf');
}*/

//ADD CART BUTTON FN
function addToCartFromAjax(id) {
    var data = new FormData();
    data.append('id', id);

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

            $('#badge-carrito').html(data.cantidad_total);
            addCantidadProducto(data.id_producto, data.cantidad_producto);


            // Add the "show" class to DIV

            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){
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
                $('#snackbar').addClass('show-snackbar');
                }, 1000);

            setTimeout(function(){
                //Ocultar el SNACKBAR
                $('#snackbar').removeClass('show-snackbar');

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

            },3000);
        }
    });
}

//REMOVE CART BUTTON FN
function removeOnCartFromAjax(id) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/remove_on_cart/' + id,
        processData:false,
        contentType:false,
        cache:false,
        dataType:'json',
        beforeSend:function(){
            $('.btn-default').prop('disabled', true);
        },
        success:function(data){
            $('#badge-carrito').html(data.cantidad_total);
            addCantidadProducto(data.id_producto, data.cantidad_producto);

            $('#snackbar-remove').addClass('show-snackbar');

            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){
                $('#snackbar-remove').removeClass('show-snackbar');
                //snackbar.className = snackbar.className.replace("show-snackbar", "");
                $('.btn-default').prop('disabled', false);
                disableRemoveBtn(data.cantidad_producto);
            }, 3000);
        }
    });
}

//ADD CART BY QUANTITY
function addToCartByQty(idProd, cant){
    var data = new FormData();
    data.append('id', idProd);
    data.append('cantidad', cant);

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
                $('#badge-carrito').html(json.cantidad_total);
                $('.loading-item-cart').fadeOut(500);
                $('.loading-aside-cart').fadeOut(500);
                $('#cart-cantidad-total').html(json.cantidad_total);
                $('#cart-subtotal').html('$ ' + json.precio_total);
                $('#total-mas-envio').html('$ ' + json.total_mas_envio);
                $('#total-producto-' + json.id_producto).html('$ ' + json.total_producto);
                $('#descripcion-envio').html(json.descripcion_envio);

                if(json.envio){
                    $('#panel-envio').fadeIn(500);
                }else{
                    $('#panel-envio').fadeOut(500);
                }

                if(json.precio_envio == 0){
                    $('#precio-envio').html("Envio Sin Costo");
                }else{
                    $('#precio-envio').html("$ " + json.precio_envio);
                }

            },1000);
            //buscar un loader para el form
            //actualizar la cifra del total + envio
            //actualizar la cifra del producto y su precio total
        },
        error:function (xhr, ajaxOptions, thrownError) {
            console.log('Mostrando el error de ajax');
            console.log(xhr.responseText);
        }

    });
}

function resetOnCartFromAjax(id) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/reset_on_cart/' + id,
        processData:false,
        contentType:false,
        cache:false,
        dataType:'json',
        success:function(data){
            $('#badge-carrito').html(data.cantidad_total);
            //agregar la cantidad al input del single item
            addCantidadProducto(data.id_producto, data.cantidad_producto);
            disableRemoveBtn(data.cantidad_producto);
            var snackbar = document.getElementById("snackbar-reset");
            // Add the "show" class to DIV
            snackbar.className = "show";
            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);
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


