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
                    
                  </div>
                  <div class="cart-table__img">
                     <img src="<?= PATH . $item['img']?>" alt="" class="subproduct__img-img">
                  </div>
               </td>
               <td class="cart-table__col">
                  <?=$item['qty']?>
               </td>
               <td>
                  <a href="cart/delete?id=<?=$id?>" data-id="<?=$id?>" class="cart-table__del">x</a>
               </td>
            </tr>
            <?php endforeach; ?>
         </table>
         <div class="cart-qty" style="display:none;"><?=$_SESSION['cart.qty']?></div>
         <a href="cart/view" class="cart-form__btn"><span class="icon-cart"></span> Перейти к оформлению</a>
         <?php else: ?>
            <div class="popup-cart__title">Корзина пуста</div>
         <?php endif; ?>
