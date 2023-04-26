$(function() {

//CART

function showCart(cart) {
    $('#cart-modal .modal-cart-content').html(cart);
    const myModalEl = document.querySelector('#cart-modal');
    const modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
    modal.show();

    if ($('.cart-qty').text()) {
        $('.count-items').text($('.cart-qty').text());
    } else {
         $('.count-items').text('0');
    }
}

   $('#get-cart').on('click', function (e) {
   		e.preventDefault();
   		$.ajax({
   			url: 'cart/show',
   			type: 'GET',
   			success: function (res) {
   				showCart(res);
   			},
   			error: function () {
   				alert('Error!');
   			}
   		});
   	});

   	$('#cart-modal .modal-cart-content').on('click', '.del-item', function (e) {
   	    e.preventDefault();
   	    const id = $(this).data('id')
   	     $.ajax({//https://dzudzylo.com/javascript/shho-take-ajax-ta-yak-vona-pratsyuye.html
                url: 'cart/delete',//url - на який відправляється запит
                type: 'GET',//метод передачі
                data: {id: id},//продукт і кільскість
                success: function (res) {
                    showCart(res);
                },
                error: function () {
                    alert('Error!');
                }
            });
         });
		
         $('#cart-modal .modal-cart-content').on('click', '#clear-cart', function () {
   	     $.ajax({//https://dzudzylo.com/javascript/shho-take-ajax-ta-yak-vona-pratsyuye.html
                url: 'cart/clear',//url - на який відправляється запит
                type: 'GET',//метод передачі
                success: function (res) {
                    showCart(res);
                },
                error: function () {
                    alert('Error!');
                }
            });
         });

 $('.add-to-cart').on('click', function (e) {//привязуємось до класу add to cart(і під час натискання буде виконуватись функція, е - дефолтна поведінка
    e.preventDefault();//запобігаємо дефолтному поведінню
    const id = $(this).data('id');//
    const qty = $('#input-quantity').val() ? $('#input-quantity').val() : 1;
    const $this = $(this);
    
    $.ajax({//https://dzudzylo.com/javascript/shho-take-ajax-ta-yak-vona-pratsyuye.html
        url: 'cart/add',//url - на який відправляється запит
        type: 'GET',//метод передачі
        data: {id: id, qty: qty},//продукт і кільскість
        success: function (res) {
            showCart(res);
            $this.find('i').removeClass('fa-shopping-cart').addClass('fa-luggage-cart');
        },
        error: function () {
            alert('Error!');
        }
    });
 });

//CART

	$('.open-search').click(function(e) {
		e.preventDefault();
		$('#search').addClass('active');
	});
	$('.close-search').click(function() {
		$('#search').removeClass('active');
	});

	$(window).scroll(function() {
		if ($(this).scrollTop() > 200) {
			$('#top').fadeIn();
		} else {
			$('#top').fadeOut();
		}
	});

	$('#top').click(function() {
		$('body, html').animate({scrollTop:0}, 700);
	});

	$('.sidebar-toggler .btn').click(function() {
		$('.sidebar-toggle').slideToggle();
	});

	$('.thumbnails').magnificPopup({
		type:'image',
		delegate: 'a',
		gallery: {
			enabled: true
		},
		removalDelay: 500,
		callbacks: {
			beforeOpen: function() {
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.mainClass = this.st.el.attr('data-effect');
			}
		}
	});

        $('#languages button').on('click', function () {
            const lang_code = $(this).data('langcode');
            window.location = PATH + '/language/change?lang=' + lang_code;
        });
});