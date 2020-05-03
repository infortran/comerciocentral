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
        success:function(data){
            $('#badge-carrito').html(data.cantidad_total);
            addCantidadProducto(data.id_producto, data.cantidad_producto);
            disableRemoveBtn(data.cantidad_producto);
            var snackbar = document.getElementById("snackbar");
            // Add the "show" class to DIV
            snackbar.className = "show";
            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);
        }
    });
}

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
        success:function(data){
            $('#badge-carrito').html(data.cantidad_total);
            addCantidadProducto(data.id_producto, data.cantidad_producto);
            disableRemoveBtn(data.cantidad_producto);
            var snackbar = document.getElementById("snackbar-remove");
            // Add the "show" class to DIV
            snackbar.className = "show";
            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 3000);
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
