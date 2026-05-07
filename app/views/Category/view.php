<main class="page">
         <section class="crumbs">
            <div class="crumbs__container">
               <div class="crumbs__contant">
                  <?= $breadcrumbs?>
               </div>
            </div>
         </section>
         <section class="subproduct">
            <div class="subproduct__container">
               <div class="subproduct__title">
                  <h4><?=$category['title']?></h4>
               </div>
               <div class="catalogpage__brand brand">
               <?php foreach($brands as $brand): ?>
                  <a href="category/<?=$category['slug']?>?brand=<?=$brand['id'] ?>" class="brand__item" <?php if(isset($_GET['brand']) && $_GET['brand'] == $brand['id']) echo 'style="border:1px solid #858585;"';?>>
                     <img src="<?= PATH . $brand['img']?>" alt="" class="brand__img">
                  </a>
               <?php endforeach;?>
               <?php if(isset($_GET['brand'])) :?>
                  <a href="category/<?=$category['slug']?>" class="brand__item" style="
                     color: #000;
                     font-size: 16px;
                     max-width: 168px;
                     text-align: center;
                     text-transform: uppercase;
                     line-height: 1.5;
                  ">
                     <p>Сбросить <br>фильтр</p>
                  </a>
               <?php endif; ?>
               </div>
               <?php if(!empty($products)) :?>
               <div class="subproduct__items">
                  <?php foreach($products as $product): ?>
                  <?php if(isset($get_brand) && $get_brand == $product['brand_id']) : ?>
                  <div class="subproduct__item">
                     <div class="subproduct__bg">
                     <div class="subproduct__icons">
                        <span class="subproduct__icon icon-like"></span>
                        <span class="subproduct__icon icon-graph"></span>
                     </div>
                     <a class="subproduct__btn" href="product/<?=$product['slug']?>">Обзор товара</a>
                     <div class="subproduct__img">
                        <img src="<?= PATH . $product['img']?>" alt="" class="subproduct__img-img">
                     </div>
                     <div class="subproduct__text"><?=mb_strimwidth($product['title'], 0, 65, '...')?></div>
                     <div class="subproduct__price">Цена по запросу</div>
                     </div>
                     
                     <?php if(isset($product['product_info']) && $product['product_info'] != '') :?>
                     <div class="product__info">
                        <ul class="product__list">
                           <?php foreach($product['product_info'] as $val) :?>
                           <div class="product__item">
                              <div class="product__key"><?=$val['info_key']?></div>
                              <div class="product__value"><?=$val['info_val']?></div>
                           </div>
                           <?php endforeach; ?>
                        </ul>
                     </div>
                     <?php endif; ?>
                     <p>Подробнее в карточке товара</p>
                     <div class="subproduct__card card-btn">
                     <a href="cart/add?id=<?=$product['id']?>" data-id="<?=$product['id']?>" class="card-btn__btn add-to-cart">
                           <span class="icon-cart"></span>
                           В корзину
                        </a>
                        <div class="card-btn__input input-col">
                           <span class="card-btn__input-min input-min">-</span>
                           <input type="number" name="number" min="1" value="1" data-num="<?=$product['id']?>" class="card-num input-num">
                           <span class="card-btn__input-plus input-plus">+</span>
                        </div>
                     </div>
                  </div>
                  <?php elseif (empty($get_brand)): ?>
                  <div class="subproduct__item">
                     <div class="subproduct__bg">
                     <div class="subproduct__icons">
                        <span class="subproduct__icon icon-like"></span>
                        <span class="subproduct__icon icon-graph"></span>
                     </div>
                     <a class="subproduct__btn" href="product/<?=$product['slug']?>">Обзор товара</a>
                     <div class="subproduct__img">
                        <img src="<?= PATH . $product['img']?>" alt="" class="subproduct__img-img">
                     </div>
                     <div class="subproduct__text"><?=mb_strimwidth($product['title'], 0, 65, '...')?></div>
                     <div class="subproduct__price">Цена по запросу</div>
                     </div>
                     
                     <?php if(isset($product['product_info']) && $product['product_info'] != '') :?>
                     <div class="product__info">
                        <ul class="product__list">
                           <?php foreach($product['product_info'] as $val) :?>
                           <div class="product__item">
                              <div class="product__key"><?=$val['info_key']?></div>
                              <div class="product__value"><?=$val['info_val']?></div>
                           </div>
                           <?php endforeach; ?>
                        </ul>
                     </div>
                     <?php endif; ?>
                     <p>Подробнее в карточке товара</p>
                     <div class="subproduct__card card-btn">
                     <a href="cart/add?id=<?=$product['id']?>" data-id="<?=$product['id']?>" class="card-btn__btn add-to-cart">
                           <span class="icon-cart"></span>
                           В корзину 
                        </a>
                        <div class="card-btn__input input-col">
                           <span class="card-btn__input-min input-min">-</span>
                           <input type="number" name="number" min="1" value="1" data-num="<?=$product['id']?>" class="card-num input-num">
                           <span class="card-btn__input-plus input-plus">+</span>
                        </div>
                     </div>
                  </div>
                  <?php endif; ?>
                  <?php endforeach;?>
               </div>
               
               <?php if($pagination->countPages > 1):?>
                  <p><?=count($products);?> товара(ов) из <?=$total;?></p>
                  <?=$pagination?>
               <?php endif;?>
               <?php endif;?>
            </div>
         </section>


      </main>