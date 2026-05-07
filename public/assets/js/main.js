//CART
function showCart(cart) {
   $('.popup-cart__contant').html(cart);

   if ($('.cart-qty').text()) {
      $('.header__cart-icon').text($('.cart-qty').text());
   } else {
      $('.header__cart-icon').text('0');
   }
}


$(".header__cart").on('click', function (e) {
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

$("#popup-cart .popup-cart__contant").on('click', '.cart-table__del', function (e) {
   e.preventDefault();
   const id = $(this).data('id');

   $.ajax({
      url: 'cart/delete',
      type: 'GET',
      data: { id: id },
      success: function (res) {
         const url = window.location.toString();
         if (url.indexOf('cart/view') !== -1) {
            window.location = url;
         } else {
            showCart(res);
         }
      },
      error: function () {
         alert('Error!');
      }
   });
});


$('.add-to-cart').on('click', function (e) {
   e.preventDefault();
   const id = $(this).data('id');
   const qty = $('[data-num="' + id + '"]').val();
   const $this = $(this);

   $.ajax({
      url: 'cart/add',
      type: 'GET',
      data: { id: id, qty: qty },
      success: function (res) {
         showCart(res);
      },
      error: function () {
         alert('Error!');
      }
   });
});


//CART


//FORM 

$('.footer__form-btn').on('click', function (e) {
   e.preventDefault();
   let name = $('#callName').val().trim();
   let phone = $('#callPhone').val().trim();
   let message = $('#callMessage').val().trim();

   if (name == '') {
      $('#callName').addClass("errorFormInput");
      return;
   } else {
      $('#callName').removeClass("errorFormInput");
   } if (phone == '') {
      $('#callPhone').addClass("errorFormInput");
      return;
   } else {
      $('#callPhone').removeClass("errorFormInput");
   }
   $.ajax({
      url: 'mail/coll',
      type: 'POST',
      cache: false,
      data: { name: name, phone: phone, message: message },
      dataType: 'html',
      beforeSend: function () {
         $('.footer__form-btn').prop("disabled", true);
      },
      success: function () {
         $('.popup-coll').removeClass('open');
         $('.popup-success').addClass('open');
         $('.popup-success__contant').html(`
               <h4>Сообщение успешно отправленно</h4>
               <p>В ближайшее время с вами свяжется наш менеджер</p>
            `);
         $('.footer__form-btn').prop("disabled", false);
      },
      error: function () {
         $('.popup-coll').removeClass('open');
         $('.popup-success').addClass('open');
         $('.popup-success__contant').html(`
            <h4 style='color:red;'>Сообщение не отправленно</h4>
            <p>Попробуйте позже</p>
         `);
         $('.footer__form-btn').prop("disabled", false);
      }
   });
});


$('#reviews-run').on('click', function (e) {
   e.preventDefault();
   let company = $('#reviewCompany').val().trim();
   let name = $('#reviewName').val().trim();
   let job = $('#reviewJob').val().trim();
   let img = $('#reviewImg').val();
   let message = $('#reviewMessage').val().trim();

   if (company == '') {
      $('#reviewCompany').addClass("errorFormInput");
      return;
   } else {
      $('#reviewCompany').removeClass("errorFormInput");
   }
   if (name == '') {
      $('#reviewName').addClass("errorFormInput");
      return;
   } else {
      $('#reviewName').removeClass("errorFormInput");
   }
   if (job == '') {
      $('#reviewJob').addClass("errorFormInput");
      return;
   } else {
      $('#reviewJob').removeClass("errorFormInput");
   }
   if (img == undefined) {
      $('.card').addClass("errorFormInput");
      return;
   } else {
      $('.card').removeClass("errorFormInput");
   }
   if (message == '') {
      $('#reviewMessage').addClass("errorFormInput");
      return;
   } else {
      $('#reviewMessage').removeClass("errorFormInput");
   }

   $.ajax({
      url: 'reviews',
      type: 'POST',
      cache: false,
      data: { company: company, name: name, job: job, img: img, message: message },
      dataType: 'html',
      beforeSend: function () {
         $('#reviews-run').prop("disabled", true);
      },
      success: function () {
         $('.popup-reviews').removeClass('open');
         $('.popup-success').addClass('open');
         $('.popup-success__contant').html(`
               <h4>Отзыв успешно отправлен</h4>
            `);
         $('#reviews-run').prop("disabled", false);
      },
      error: function () {
         $('.popup-reviews').removeClass('open');
         $('.popup-success').addClass('open');
         $('.popup-success__contant').html(`
            <h4 style='color:red;'>Отзыв не отправлен</h4>
         `);
         $('#reviews-run').prop("disabled", false);
      }
   });
});


