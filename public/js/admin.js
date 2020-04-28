function readURL(input, selector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(selector).attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}



$(document).ready(function(){

    jQuery('.productos-list-slide-create').select2({
        placeholder:'Seleccione un producto',
        allowClear:true
    });



    $('#div_cancel_edit_admin').hide();
    $('#btn_update_admin').hide();
    $('#form-agregar-social').hide();
    $('#form-agregar-social-user').hide();

	$("#img-input-producto").change(function(){
        var selector = $('#img-create-producto');
        readURL(this, selector);
	});

    $('#input_edit_img_admin').change(function(){
        var selector = $('#img_admin');
        readURL(this, selector);
    });

    $('#input-img-create-main-slide').change(function(){
       var selector = $('#img-create-main-slide') ;
       readURL(this, selector);
    });

    $('#input-img-create-pricing-slide').change(function(){
        var selector = $('#img-create-pricing-slide') ;
        readURL(this, selector);
    });

    $('#input-img-create-logo-slide').change(function(){
        var selector = $('#img-create-logo-slide') ;
        readURL(this, selector);
    });



    $('#btn_edit_admin').click(function(e){
        e.preventDefault();
        $('#input_edit_name_admin').prop("disabled", false);
        $('#input_edit_email_admin').prop("disabled", false);
        $('#input_edit_img_admin').prop("disabled", false);
        $('#div_cancel_edit_admin').fadeIn(2000);
        $('#btn_update_admin').fadeIn();
        $(this).hide();
    });

    $('#btn_cancel_edit_admin').click(function(e){
        e.preventDefault();
        $('#input_edit_name_admin').prop("disabled", true);
        $('#input_edit_email_admin').prop("disabled", true);
        $('#input_edit_img_admin').prop("disabled", true);
        $('#div_cancel_edit_admin').hide();
        $('#btn_update_admin').hide();
        $('#btn_edit_admin').fadeIn(2000);
    });


    //BOTON AGREGAR SOCIALS
    $('#btn-create-social').click(function(){
        $('#form-agregar-social').fadeIn(2000);
    });
    $('#btn-back-social').click(function () {
        $('#form-agregar-social').fadeOut(2000);
    });

    $('#btn-add-social-user').click(function(){
        $('#form-agregar-social-user').fadeIn(2000);
    });
    $('#btn-back-social-user').click(function () {
        $('#form-agregar-social-user').fadeOut(2000);
    });


});

