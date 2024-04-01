$('#two').owlCarousel({loop:true,margin:10,nav:false, responsive:{0:{items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})

$('#one').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
})


$(document).ready(function(){
	$(".gallery a[rel^='prettyPhoto']").prettyPhoto({});
	});