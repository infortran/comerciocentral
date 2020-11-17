$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
    $('.popover-dismiss').popover({
        trigger: 'focus'
    });
    $('form').areYouSure(
        {'message':'Hay datos sin guardar!, estas seguro que quieres salir?'}
    );

    jQuery('.productos-list-slide-create').select2({
        placeholder:'Seleccione un producto',
        allowClear:true
    });


	$("#img-input-producto").change(function(){
        var selector = $('#img-create-producto');
        readURL(this, selector);
        if(this.files[0].size > 2097152){
            alert("La imagen supera el límite de tamaño (2MB)");
            this.value = "";
        }
	});

});

function readURL(input, selector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(selector).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

