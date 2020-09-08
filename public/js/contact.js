jQuery(function ($) {
    'use strict';

    var form = $('.contact-form');
    form.submit(function () {
        var $this = $(this);
        $.post("sendemail.php", $(".contact-form").serialize(), function (result) {
            if (result.type == 'success') {
                $this.prev().text(result.message).fadeIn().delay(3000).fadeOut();
            }
        });
        return false;
    });

});

// Google Map Customization
(function () {

    var map;

    map = new GMaps({
        el: '#gmap',
        lat: -32.7400505,
        lng: -70.7414159,
        scrollwheel: false,
        zoom: 16,
        zoomControl: false,
        panControl: false,
        streetViewControl: false,
        mapTypeControl: false,
        overviewMapControl: false,
        clickable: false
    });

    var image = 'images/map-icon.png';
    map.addMarker({
        lat: -32.7400505,
        lng: -70.7414159,
        //icon: image,
        animation: google.maps.Animation.DROP,
        verticalAlign: 'bottom',
        horizontalAlign: 'center',
        backgroundColor: '#ffffff',
    });

    /*var styles = [

        {
            "featureType": "road",
            "stylers": [
                {
                    "color": ""
                }
		]
	}, {
            "featureType": "water",
            "stylers": [
                {
                    "color": "#A2DAF2"
                }
		]
	}, {
            "featureType": "landscape",
            "stylers": [
                {
                    "color": "#ABCE83"
                }
		]
	}, {
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "color": "#000000"
                }
		]
	}, {
            "featureType": "poi",
            "stylers": [
                {
                    "color": "#2ECC71"
                }
		]
	}, {
            "elementType": "labels.text",
            "stylers": [
                {
                    "saturation": 1
                },
                {
                    "weight": 0.1
                },
                {
                    "color": "#111111"
                }
		]
	}

	];

    map.addStyle({
        styledMapName: "Styled Map",
        styles: styles,
        mapTypeId: "map_style"
    });

    map.setStyle("map_style");*/
}());
