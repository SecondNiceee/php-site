<main class="page">
         <section class="crumbs">
            <div class="crumbs__container">
               <div class="crumbs__contant">
                  <a href="/" class="crumbs__item">Главная</a>
                  <span class="crumbs__separator">/</span>
                  <span class="crumbs__item crumbs__item_active"><?=$brand['title']?></span>
               </div>
            </div>
         </section>
         <section class="subproduct">
            <div class="subproduct__container">
               <div class="subproduct__title">
                  <h1><?=$brand['title']?></h1>
               </div>
               <?php if(!empty($brand['content'])): ?>
               <div class="brand-content">
                  <?=$brand['content']?>
               </div>
               
               <style>
                  .brand-content {
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
                  .brand-content p {
                     margin-bottom: 15px;
                  }
                  .brand-content p:last-child {
                     margin-bottom: 0;
                  }
                  .brand-content h2,
                  .brand-content h3,
                  .brand-content h4,
                  .brand-content h5,
                  .brand-content h6 {
                     font-weight: 700;
                     margin-bottom: 15px;
                     margin-top: 25px;
                     color: #082a43;
                  }
                  .brand-content h2:first-child,
                  .brand-content h3:first-child,
                  .brand-content h4:first-child,
                  .brand-content h5:first-child,
                  .brand-content h6:first-child {
                     margin-top: 0;
                  }
                  .brand-content ul,
                  .brand-content ol {
                     margin-bottom: 15px;
                     padding-left: 25px;
                  }
                  .brand-content li {
                     margin-bottom: 8px;
                  }
                  .brand-content a {
                     color: #2f72cf;
                     text-decoration: none;
                     -webkit-transition: all .3s ease 0s;
                     -o-transition: all .3s ease 0s;
                     transition: all .3s ease 0s;
                  }
                  .brand-content a:hover {
                     color: #082a43;
                  }
                  .brand-content img {
                     max-width: 100%;
                     height: auto;
                     border-radius: 5px;
                     margin: 15px 0;
                  }
                  .brand-content table {
                     width: 100%;
                     border-collapse: collapse;
                     margin-bottom: 15px;
                  }
                  .brand-content th,
                  .brand-content td {
                     border: 1px solid #f6f6f6;
                     padding: 10px 15px;
                     text-align: left;
                  }
                  .brand-content th {
                     background: #f3f8fb;
                     font-weight: 700;
                  }
                  @media (max-width: 991.98px) {
                     .brand-content {
                        font-size: 15px;
                        padding: 20px;
                     }
                  }
                  @media (max-width: 767.98px) {
                     .brand-content {
                        font-size: 14px;
                        padding: 15px;
                        margin-bottom: 20px;
                     }
                     .brand-content h2 {
                        font-size: 22px;
                     }
                     .brand-content h3 {
                        font-size: 20px;
                     }
                     .brand-content h4 {
                        font-size: 18px;
                     }
                  }
                  @media (max-width: 479.98px) {
                     .brand-content {
                        padding: 12px;
                        font-size: 13px;
                     }
                  }
               </style>
               <?php endif; ?>
               
               <div class="brand-logo-display" style="text-align: center; margin-bottom: 30px;">
                  <img src="<?=PATH . $brand['img']?>" alt="<?=$brand['title']?>" style="max-width: 200px; height: auto;">
               </div>
               
               <?php if(!empty($products_arr)) :?>
               <div class="subproduct__items">
                  <?php foreach($products_arr as $product): ?>
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
                  <?php endforeach;?>
               </div>
               
               <?php if($pagination->countPages > 1):?>
                  <p><?=count($products_arr);?> товара(ов) из <?=$total;?></p>
                  <?=$pagination?>
               <?php endif;?>
               <?php else: ?>
               <div style="text-align: center; padding: 50px 0;">
                  <p style="font-size: 18px; color: #082a43;">Товары этого бренда временно отсутствуют</p>
               </div>
               <?php endif;?>
            </div>
         </section>

         <!-- Блок Вопросы-Ответы -->
         <?= \app\widgets\FaqWidget::render('brand', $brand['id']) ?>

      </main>
