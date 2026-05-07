<main class="page">
         <section class="crumbs">
            <div class="crumbs__container">
               <div class="crumbs__contant"><a class="crumbs__link" href="<?=PATH?>">Главная страница</a>
                  &nbsp;&nbsp;/&nbsp;&nbsp; <a>Корзина</a> 
               </div>
            </div>
         </section>
         <section class="cart">
            <div class="cart__container">
               <div class="cart__title">
                  <h4>Корзина</h4>
               </div>
               <style>
                  .error {
                     background: #fd4444;
                     padding: 10px 20px;
                     border-radius: 10px;
                     color: #fff;
                  }
                  .success {
                     background: #2f72cf;
                     padding: 10px 20px;
                     border-radius: 10px;
                     color: #fff;
                  }
               </style>
               <?php 
                  if(!empty($_SESSION['errors'])) {
                     echo '<div class="error">' . $_SESSION['errors'] . '</div>';
                     unset($_SESSION['errors']);
                  }
                  if(!empty($_SESSION['success'])) {
                     echo '<div class="success">' . $_SESSION['success'] . '</div>';
                     unset($_SESSION['success']);
                  }  
               ?>
             
               <?php if (!empty($_SESSION['cart'])) : ?>
         <table class="cart__contant cart-table">
            <tr class="cart-table__title">
               <th>Наименование</th>
               <th>Количество</th>
               <th></th>
            </tr>
            <?php foreach($_SESSION['cart'] as $id => $item) :?>
            <tr class="cart-table__list">
               <td class="cart-table__body">
                  <div class="cart-table__text">
                     <a href="product/<?=$item['slug']?>" class="cart-table__name"><?=$item['title']?></a>
                     <?php if(!empty($item['product_info'])): ?>
                     <div class="cart-table__info">
                        <ul>
                           <?php foreach($item['product_info'] as $value): ?>
                           <li><?=$value['info_key']?>: <?=$value['info_val']?></li>
                           <?php endforeach;?>
                        </ul>
                     </div>
                     <?php endif; ?>
                  </div>
                  <div class="cart-table__img">
                     <img src="<?= PATH . $item['img']?>" alt="" class="subproduct__img-img">
                  </div>
               </td>
               <td class="cart-table__col">
                  <div class="cart-table__input input-col">
                     <span class="cart-table__input-min input-min">-</span>
                     <input type="number" name="number" min="1" value="<?=$item['qty']?>" class="cart-table__num input-num">
                     <span class="cart-table__input-plus input-plus">+</span>
                  </div>
               </td>
               <td>
                  <a href="cart/delete?id=<?=$id?>" data-id="<?=$id?>" class="cart-table__del">x</a>
               </td>
            </tr>
            <?php endforeach; ?>
         </table>
         <div class="cart-qty" style="display:none;"><?=$_SESSION['cart.qty']?></div>
         

               <div class="cart__form"> 
                  <div class="cart__form-title">Оформление заказа на расчет стоимости</div>
                  <form action="cart/checkout" method="post" class="cart__form-form cart-form">
                     <div class="cart-form__inputs">
                        <div class="cart-form__input">
                           <label for="fio">ФИО<span>*</span></label>
                           <input type="text" name="fio" id="fio">
                        </div>
                        <div class="cart-form__input">
                           <label for="company">Наименование организации</label>
                           <input type="text" name="company" id="company">
                        </div>
                        <div class="cart-form__input">
                           <label for="tel">Телефон<span>*</span></label>
                           <input type="text" name="phone" id="tel">
                        </div>
                        <div class="cart-form__input">
                           <label for="mail">E-mail</label>
                           <input type="text" name="email" id="mail">
                        </div>
                     </div>
                     <div class="cart-form__textarea">
                        <label for="message">Сообщение</label>
                        <textarea name="note" id="message" cols="30" rows="3"></textarea>
                     </div>
                     <button class="cart-form__btn" type="submit"><span class="icon-cart"></span> Отправить заявку на
                        расчет</button>
                  </form>
               </div>
               <?php else: ?>
            <div class="popup-cart__title">Корзина пуста</div>
         <?php endif; ?>
            </div>
         </section>

      </main>