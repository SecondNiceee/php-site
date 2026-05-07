<?php
      use shop\View;
?>

<footer class="footer">
   <div class="footer__container">
      <a href="" class="footer__logo"><picture><source srcset="/assets/img/logo.webp" type="image/webp"><img src="/assets/img/logo.png" alt=""></picture></a>
      <div class="footer__contant">
         <div class="footer__items">
            <div class="footer__title">Компания</div>
            <?php
                new \app\widgets\page\Page([
                  'class' => 'footer__list',
                  'menu' => 'company',
                  'prepend' => '
                     <li class="menu__item"><a href="/about" class="menu__link">О компании</a></li>
                  ',
                  
               ]);
            ?>
         </div>
         <div class="footer__items">
            <div class="footer__title">Покупателям</div>
            <?php
                new \app\widgets\page\Page([
                  'class' => 'footer__list',
                  'menu' => 'buyers',
                  
               ]);
            ?>
         </div>
         <div class="footer__items">
            <div class="footer__title">Наши контакты</div>
            <div class="footer__contacts">
               <div class="footer__adres">Москва, улица Талдомская, 2г</div>
               <a href="tel:+7(499) 394-48-93" class="footer__phone">+7 (499) 394-48-93</a>
               <a href="mailto:potokllc@gmail.com" class="footer__email">potokllc@gmail.com</a>
            </div>

         </div>
         <div class="footer__items">
            <div class="footer__title">Консультация специалиста</div>
            <form class="footer__form">
               <input type="text" name="name" id="callName" placeholder="Ваше имя">
               <input type="tel" name="tel" id="callPhone" placeholder="Ваш телефон">
               <textarea name="message" id="callMessage" rows="5" placeholder="Сообщение"></textarea>
               <input type="submit" class="footer__form-btn" value="отправить заявку">
            </form>
         </div>
      </div>
   </div>
</footer>
</div>
   <div id="popup-cart" class="popup-cart popup">
      <div class="popup-cart__body">
         <a href="" class="popup-cart__close close-popup"></a>
         <div class="popup-cart__contant no-close">
            
         </div>
      </div>
   </div>
   <div id="popup-success" class="popup-success popup">
      <div class="popup-success__body">
         <a href="" class="popup-success__close close-popup"></a>
         <div class="popup-success__contant no-close">
            
         </div>
      </div>
   </div>
   <div id="popup-coll" class="popup-coll popup">
      <div class="popup-coll__body">
         <a href="" class="popup-coll__close close-popup"></a>
         <div class="popup-coll__contant no-close">
            <div class="footer__title">Консультация специалиста</div>
            <form class="footer__form">
               <input type="text" name="name" id="callName" placeholder="Ваше имя">
               <input type="tel" name="tel" id="callPhone" placeholder="Ваш телефон">
               <textarea name="message" id="callMessage" rows="5" placeholder="Сообщение"></textarea>
               <input type="submit" class="footer__form-btn" value="отправить заявку">
            </form>
         </div>
      </div>
   </div>
   <script>
      const PATH = '<?= PATH ?>';
      window.onload = function () {
         setTimeout(function () {
            
            document.querySelector('body').style.opacity = '1';
         }, 500);
      }
   </script>
   <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
   <script src="/assets/js/app.min.js?-v=20221018171731"></script>
   <script src="/assets/js/main.js"></script>
</body>
</html>