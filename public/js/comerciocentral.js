(function ($) {
    "use strict";
// TOP Menu Sticky
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 400) {
            $("#sticky-header").removeClass("sticky");
            $('#back-top').fadeIn(500);
        } else {
            $("#sticky-header").addClass("sticky");
            $('#back-top').fadeIn(500);
        }
    });

    function nextStep(){
        $('#carouselRegistro').carousel('next');
        $('#carouselRegistro').carousel({
            pause:true,
            interval:false
        });
    }


    $(document).on('click', '#btn-registrar-next',function(){
        if($(this).data('account') == 'create'){
            nextStep();
        }else{
            location.href = '/login';
        }

    });

    $(document).on('click', '#btn-registrar-next-step-1',function(){
        nextStep();
    });

    $(document).on('click', '#btn-create-account', function(){
        $(this).addClass('btn-hover');
        $('#btn-registrar-next').data('account', 'create');
        $('#btn-has-account').removeClass('btn-hover');
    });

    $(document).on('click', '#btn-has-account', function(){
        $(this).addClass('btn-hover');
        $('#btn-registrar-next').data('account', 'has-account');
        $('#btn-create-account').removeClass('btn-hover');
    });

    //cada vez que ingreso un nombre de tienda
    $(document).on('input','#nombre-tienda', function(){
        var domain = $('#nombre-tienda').val().replace(/\s+/g, '').toLowerCase();

        if(domain === ""){
            $('#domain-dinamic').css('color', 'red');
            $('#domain-dinamic').html('<i class="fa fa-times-circle"></i> Debe ingresar una tienda');
        }else{
            $('#domain-dinamic').css('color', '#00023d');
            $('#domain-dinamic').html('<i id="domain-dinamic-symbol" class="fa fa-check-circle" style="color: green"></i>\n' +
                'https://<strong id="domain-tienda" style="color:#6d2ead"></strong>.comerciocentral.cl')
        }
        $('#domain-tienda').html(domain);
    });

    $(document).on('change', '#nombre-tienda', function(){
        var domain = $(this).val().replace(/\s+/g, '');
        var email = $('#email-tienda').val();
        if(domain !== ""){
            checkDomainAndEmail(domain, email);
        }
    });

    $(document).on('input', '#email', function(){
        var email = $(this).val();
        checkEmail(email);
    });

    $(document).on('change', '#email-tienda', function(){
        var email = $(this).val();
        var domain = $('#nombre-tienda').val().replace(/\s+/g, '');
        checkDomainAndEmail(domain, email);
    });

    function checkDomainAndEmail(domain, email){
        checkTiendaEmail(email);
        checkDomain(domain);
        checkTiendaDomainEmail(domain,email);
    }

    function checkEmail(email){
        $.ajax({
            url:'registro/checkemail/' + email,
            dataType:'json',
            success:function(data){
                if(data.email_status){
                    $('#email_error').addClass('d-none');
                    $('.actions ul li').removeClass('d-none');
                }else{
                    $('#email_error').removeClass('d-none');
                    $('.actions ul li').addClass('d-none');
                }
            }
        });
    }

    function checkTiendaDomainEmail(domain, email){
        $.ajax({
            url:'registro/checktiendadomainemail/'+ domain + '/' + email,
            dataType:'json',
            success:function(data){
                if(data.domain_email_tienda_status){
                    $('.actions ul li').removeClass('d-none');
                }else{
                    $('.actions ul li').addClass('d-none');
                }
            }
        });
    }

    function checkTiendaEmail(email){
        $.ajax({
            url:'registro/checktiendaemail/' + email,
            dataType:'json',
            success:function(data){
                if(data.email_tienda_status){
                    $('#email_tienda_error').addClass('d-none');
                }else{
                    $('#email_tienda_error').removeClass('d-none')
                }
            }
        })
    }

    function checkDomain(domain){
        $.ajax({
            url:'registro/checktienda/' + domain,
            dataType:'json',
            success:function(data){
                if(data.domain_status){
                    $('#domain-dinamic').css('color', '#00023d');
                    $('#domain-tienda').css('color', '#6d2ead');
                    //$('.actions ul li').removeClass('d-none');
                    $('#domain-dinamic-symbol').removeClass('fa-exclamation-circle').addClass('fa-check-circle').css('color', 'green');
                }else{
                    $('#domain-dinamic').css('color', 'red');
                    $('#domain-tienda').css('color', 'red');
                    //$('.actions ul li').addClass('d-none');
                    $('#domain-dinamic-symbol').addClass('fa-exclamation-circle').removeClass('fa-check-circle').css('color', 'red');
                }
            }
        });
    }


    $(document).ready(function(){



        $("#form-total").steps({
            headerTag: "h2",
            bodyTag: "section",
            transitionEffect: "fade",
            // enableAllSteps: true,
            autoFocus: true,
            transitionEffectSpeed: 500,
            titleTemplate : '<div class="title">#title#</div>',
            labels: {
                previous : '<i class="fa fa-chevron-left"></i> Atras',
                next : 'Siguiente <i class="fa fa-chevron-right"></i>',
                finish : '<i class="fa fa-user-check"></i> Registrarse',
                current : ''
            },
            onStepChanging: function (event, currentIndex, newIndex) {
                var username = $('#username').val();
                var userlastname = $('#userlastname').val();
                var email = $('#email').val();
                var nombretienda = $('#nombre-tienda').val();
                var domaintienda = $('#domain-tienda').html();
                var emailtienda = $('#email-tienda').val();
                var telefonotienda = $('#telefono-tienda').val();
                var infotienda = $('#info-tienda').val();

                $('#user-fullname-val').text(username + ' ' + userlastname);
                $('#email-val').text(email);
                $('#nombre-tienda-val').text(nombretienda);
                $('#url-tienda-val').text('https://'+ domaintienda + '.comerciocentral.cl');
                $('#email-tienda-val').text(emailtienda);
                $('#tel-tienda-val').text(telefonotienda);
                $('#info-tienda-val').text(infotienda);

                $("#form-register").validate({
                    ignore : ":disabled,:hidden",
                    rules:{
                        username:{
                          required:true,
                          minlength:3,
                          maxlength:10
                        },
                        userlastname:{
                          required:true,
                          minlength:3,
                          maxlength:10
                        },
                        email:{
                          email:true,
                          required:true,
                          minlength:10,
                          maxlength:50
                        },
                        password:{
                            required:true,
                            minlength:8
                        },
                        confirm_password:{
                            required:true,
                            minlength:8,
                            equalTo: '#password'
                        },
                        nombre_tienda:{
                            required:true,
                            minlength:2,
                            maxlength:30
                        },
                        email_tienda: {
                            email:true,
                            required:true,
                            minlength:3,
                            maxlength:50
                        },
                        telefono_tienda:{
                            number:true,
                            required:true,
                            minlength:8,
                            maxlength:9
                        },
                        info_tienda:{
                            required:true,
                            minlength:20,
                            maxlength:200
                        }
                    },
                    messages:{
                        username:{
                            required:"<i class='fa fa-times-circle' style='color:red'></i><strong> NOMBRE</strong> requerido",
                            minlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener minimo 3 caracteres",
                            maxlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener maximo 10 caracteres"
                        },
                        userlastname:{
                            required:"<i class='fa fa-times-circle' style='color:red'></i><strong> APELLIDO</strong> requerido",
                            minlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener minimo 3 caracteres",
                            maxlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener maximo 10 caracteres"
                        },
                        password:{
                            required:"<i class='fa fa-times-circle' style='color:red'></i> <strong>CONTRASEÑA</strong> requerido",
                            minlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener minimo 8 caracteres"
                        },
                        confirm_password:{
                            required:"<i class='fa fa-times-circle' style='color:red'></i> <strong>REPETIR</strong> requerido",
                            minlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener minimo 8 caracteres",
                            equalTo:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe ingresar la misma contraseña"
                        },
                        email:{
                            email: "<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Ingrese un formato de email valido",
                            required: "<i class='fa fa-times-circle' style='color:red'></i> El campo <strong>EMAIL</strong> es requerido",
                            minlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener minimo 10 caracteres",
                            maxlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener maximo 20 caracteres"
                        },
                        nombre_tienda:{
                            required:'',
                            minlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener minimo 2 caracteres",
                            maxlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener maximo 30 caracteres"
                        },
                        email_tienda:{
                            email: "<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Ingrese un formato de email valido",
                            required: "<i class='fa fa-times-circle' style='color:red'></i> El campo <strong>EMAIL</strong> es requerido",
                            minlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener minimo 10 caracteres",
                            maxlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener maximo 20 caracteres"
                        },
                        telefono_tienda:{
                            number: "<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Solo puede ingresar numeros",
                            required: "<i class='fa fa-times-circle' style='color:red'></i> El campo <strong>TELEFONO</strong> es requerido",
                            minlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener minimo 8 caracteres",
                            maxlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener maximo 9 caracteres"
                        },
                        info_tienda:{
                            required: "<i class='fa fa-times-circle' style='color:red'></i> El campo <strong>INFORMACION</strong> es requerido",
                            minlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener minimo 20 caracteres",
                            maxlength:"<i class='fa fa-exclamation-triangle' style='color:yellow'></i> Debe contener maximo 50 caracteres"
                        }



                    }
                });
                return $("#form-register").valid();
            },onFinished(event, i){
                $('#form-register').submit();
            }
        });

// mobile_menu
        var menu = $('ul#navigation');
        if(menu.length){
            menu.slicknav({
                prependTo: ".mobile_menu",
                closedSymbol: '+',
                openedSymbol:'-'
            });
        };
// blog-menu
        // $('ul#blog-menu').slicknav({
        //   prependTo: ".blog_menu"
        // });

// review-active

        var slider = $('.slider_active');
        if(slider.length) {
            slider.owlCarousel({
                loop:true,
                margin:0,
                items:1,
                autoplay:true,
                navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
                nav:true,
                dots:false,
                autoplayHoverPause: true,
                autoplaySpeed: 800,
                responsive:{
                    0:{
                        items:1,
                        nav:false,
                    },
                    767:{
                        items:1,
                        nav:false,
                    },
                    992:{
                        items:1,
                        nav:false
                    },
                    1200:{
                        items:1,
                        nav:false
                    },
                    1600:{
                        items:1,
                        nav:true
                    }
                }
            });
        }



// review-active
        var testmonial = $('.testmonial_active');
        if(testmonial.length){
            testmonial.owlCarousel({
                loop:true,
                margin:0,
                autoplay:true,
                navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
                nav:true,
                dots:false,
                autoplayHoverPause: true,
                autoplaySpeed: 800,
                responsive:{
                    0:{
                        items:1,
                        dots:false,
                        nav:false,
                    },
                    767:{
                        items:1,
                        dots:false,
                        nav:false,
                    },
                    992:{
                        items:1,
                        nav:true
                    },
                    1200:{
                        items:1,
                        nav:true
                    },
                    1500:{
                        items:1
                    }
                }
            });
        }




// for filter
        // init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: 1
            }
        });

        // filter items on button click
        $('.portfolio-menu').on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({ filter: filterValue });
        });

        //for menu active class
        $('.portfolio-menu button').on('click', function (event) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });

        // wow js
        new WOW().init();

        // counter
        $('.counter').counterUp({
            delay: 10,
            time: 10000
        });

        /* magnificPopup img view */
        $('.popup-image').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        /* magnificPopup img view */
        $('.img-pop-up').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        /* magnificPopup video view */
        $('.popup-video').magnificPopup({
            type: 'iframe'
        });

        // blog-page

        //brand-active
        var brand = $('.brad_active');
        if(brand.length){
            brand.owlCarousel({
                loop:true,
                autoplay:true,
                nav:false,
                dots:false,
                autoplayHoverPause: true,
                autoplaySpeed: 800,
                responsive:{
                    0:{
                        items:2,
                        nav:false
                    },
                    767:{
                        items:4
                    },
                    992:{
                        items:5
                    }
                }
            });
        }


// blog-dtails-page

        if (document.getElementById('default-select')) {
            $('select').niceSelect();
        }

        //about-pro-active
        $('.details_active').owlCarousel({
            loop:true,
            margin:0,
            items:1,
// autoplay:true,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
            nav:true,
            dots:false,
// autoplayHoverPause: true,
// autoplaySpeed: 800,
            responsive:{
                0:{
                    items:1,
                    nav:false

                },
                767:{
                    items:1,
                    nav:false
                },
                992:{
                    items:1,
                    nav:false
                },
                1200:{
                    items:1,
                }
            }
        });

    });

// resitration_Form
    $(document).ready(function() {
        $('.popup-with-form').magnificPopup({
            type: 'inline',
            preloader: false,
            focus: '#name',

            // When elemened is focused, some mobile browsers in some cases zoom in
            // It looks not nice, so we disable it:
            callbacks: {
                beforeOpen: function() {
                    if($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });
    });



//------- Mailchimp js --------//
    function mailChimp() {
        $('#mc_embed_signup').find('form').ajaxChimp();
    }
    mailChimp();



    // Search Toggle
    $("#search_input_box").hide();
    $("#search").on("click", function () {
        $("#search_input_box").slideToggle();
        $("#search_input").focus();
    });
    $("#close_search").on("click", function () {
        $('#search_input_box').slideUp(500);
    });
    // Search Toggle
    $("#search_input_box").hide();
    $("#search_1").on("click", function () {
        $("#search_input_box").slideToggle();
        $("#search_input").focus();
    });
    $(document).ready(function() {
        $('select').niceSelect();
    });

    // prise slider


    $('#datepicker').datepicker({
        iconsLibrary: 'fontawesome',
        icons: {
            rightIcon: '<span class="fa fa-caret-down"></span>'
        }
    });





})(jQuery);
