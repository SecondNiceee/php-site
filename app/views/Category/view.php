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
                  <h1 style="font-weight: 700; font-size: 24px; margin-bottom: 15px;"><?=$category['title']?></h1>
               </div>
               <?php if(!empty($category['content'])): ?>
               <div class="category-content">
                  <?=$category['content']?>
               </div>
               
               <style>
                  .category-content {
                     font-weight: 300;
                     font-size: 16px;
                     color: #082a43;
                     line-height: 1.6;
                     margin-bottom: 30px;
                     padding: 25px;
                     background: -o-linear-gradient(181.66deg,#f3f8fb 5.64%,#fdfdfd 98.88%);
                     background: linear-gradient(268.34deg,#f3f8fb 5.64%,#fdfdfd 98.88%);
                     border: 1px solid #f6f6f6;
                     border-radius: 5px;
                  }
                  .category-content p {
                     margin-bottom: 15px;
                  }
                  .category-content p:last-child {
                     margin-bottom: 0;
                  }
                  .category-content h2,
                  .category-content h3,
                  .category-content h4,
                  .category-content h5,
                  .category-content h6 {
                     font-weight: 700;
                     margin-bottom: 15px;
                     margin-top: 25px;
                     color: #082a43;
                  }
                  .category-content h2:first-child,
                  .category-content h3:first-child,
                  .category-content h4:first-child,
                  .category-content h5:first-child,
                  .category-content h6:first-child {
                     margin-top: 0;
                  }
                  .category-content ul,
                  .category-content ol {
                     margin-bottom: 15px;
                     padding-left: 25px;
                  }
                  .category-content li {
                     margin-bottom: 8px;
                  }
                  .category-content a {
                     color: #2f72cf;
                     text-decoration: none;
                     -webkit-transition: all .3s ease 0s;
                     -o-transition: all .3s ease 0s;
                     transition: all .3s ease 0s;
                  }
                  .category-content a:hover {
                     color: #082a43;
                  }
                  .category-content img {
                     max-width: 100%;
                     height: auto;
                     border-radius: 5px;
                     margin: 15px 0;
                  }
                  .category-content table {
                     width: 100%;
                     border-collapse: collapse;
                     margin-bottom: 15px;
                  }
                  .category-content th,
                  .category-content td {
                     border: 1px solid #f6f6f6;
                     padding: 10px 15px;
                     text-align: left;
                  }
                  .category-content th {
                     background: #f3f8fb;
                     font-weight: 700;
                  }
                  @media (max-width: 991.98px) {
                     .category-content {
                        font-size: 15px;
                        padding: 20px;
                     }
                  }
                  @media (max-width: 767.98px) {
                     .category-content {
                        font-size: 14px;
                        padding: 15px;
                        margin-bottom: 20px;
                     }
                     .category-content h2 {
                        font-size: 22px;
                     }
                     .category-content h3 {
                        font-size: 20px;
                     }
                     .category-content h4 {
                        font-size: 18px;
                     }
                  }
                  @media (max-width: 479.98px) {
                     .category-content {
                        padding: 12px;
                        font-size: 13px;
                     }
                  }
               </style>
               <?php endif; ?>
               
               <div class="catalogpage__brand brand">
               <?php foreach($brands as $brand): ?>
                  <a href="category/<?=$category['slug']?>/<?=$brand['slug'] ?>" class="brand__item" <?php if(isset($get_brand) && $get_brand == $brand['id']) echo 'style="border:1px solid #858585;"';?>>
                     <img src="<?= PATH . $brand['img']?>" alt="" class="brand__img">
                  </a>
               <?php endforeach;?>
               <?php if(!empty($get_brand)) :?>
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
               <?php else: ?>
               <div class="subproduct__empty" style="
                  text-align: center;
                  padding: 60px 20px;
                  background: linear-gradient(268.34deg, #f3f8fb 5.64%, #fdfdfd 98.88%);
                  border: 1px solid #f6f6f6;
                  border-radius: 5px;
                  margin-top: 20px;
               ">
                  <div style="font-size: 48px; margin-bottom: 20px; opacity: 0.5;">📦</div>
                  <h3 style="font-size: 20px; font-weight: 600; color: #082a43; margin-bottom: 10px;">Товаров пока нет</h3>
                  <p style="font-size: 16px; color: #666; max-width: 400px; margin: 0 auto;">В данной категории пока нет товаров. Скоро они появятся!</p>
               </div>
               <?php endif;?>
               
               <!-- Блок Вопросы-Ответы -->
               <?= \app\widgets\FaqWidget::render('category', $category['id']) ?>
            </div>
         </section>


      </main>
