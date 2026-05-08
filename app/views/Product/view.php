<main class="page">
         <section class="crumbs">
            <div class="crumbs__container">
               <div class="crumbs__contant"><?= $breadcrumbs?></div>
            </div>
         </section>
         
         <section class="product">
            <div class="product__container">
               <div class="product__title">
                  <h1 class="product__h1"><?=$product['title']?></h1>
               </div>
               <div class="product__wrapper">
                  <div class="product__body">
                     <div class="product__img">
                        <img class="product__img-img" src="<?= PATH . $product['img']?>" alt="">
                     </div>
                     <div class="product__info">
                        <div class="product__name"><?=$product['title']?></div>
                        <div class="product__description"><?=$product['content']?></div>
                        <?php if(!empty($product_info)):?>
                        <ul class="product__list">
                           <?php foreach($product_info as $pi):?>
                           <div class="product__item">
                              <div class="product__key"><?=$pi['info_key']?></div>
                              <div class="product__value"><?=$pi['info_val']?></div>
                           </div>
                           <?php endforeach;?>
                        </ul>
                        <?php endif;?>
                        <div class="product__links">
                           <?php if(!empty($product['brochure'])): ?>
                           <a href="<?=$product['brochure']?>" class="product__link" target="_blanck">
                              <picture><source srcset="<?= PATH ?>/assets/img/icons/broshura.webp" type="image/webp"><img class="product__link-img" src="<?= PATH ?>/assets/img/icons/broshura.png" alt=""></picture>
                              Брошюра
                           </a>
                           <?php endif;?>
                           <?php if(!empty($product['tech_desc'])): ?>
                           <a href="<?=$product['tech_desc']?>" class="product__link" target="_blanck">
                              <picture><source srcset="<?= PATH ?>/assets/img/icons/description.webp" type="image/webp"><img class="product__link-img" src="<?= PATH ?>/assets/img/icons/description.png" alt=""></picture>
                              Тех.описание
                           </a>
                           <?php endif;?>
                        </div>
                     </div>
                  </div>
                  <div class="product__sidebar">
                     <div class="product__sidebar-title">
                        <h6>Цена по запросу</h6>
                     </div>
                     
                     <div class="product__card card-btn">
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
                     <!-- <div class="product__icons">
                        <a href="#" class="product__icon">
                           <span class="icon-like"></span>
                           К сравнению
                        </a>
                        <a href="" class="product__icon">
                           <span class="icon-graph"></span>
                           В избранное
                        </a>
                     </div> -->
                  </div>
               </div>
            </div>
         </section>
         <br><br><br>
         <!-- <section class="subproduct">
            <div class="subproduct__container">
               <div class="subproduct__title">
                  <h4>Похожие товары</h4>
               </div>
               <div class="subproduct__items">
                  <div class="subproduct__item">
                     <div class="subproduct__icons">
                        <span class="subproduct__icon icon-like"></span>
                        <span class="subproduct__icon icon-graph"></span>
                     </div>
                     <a class="subproduct__btn" href="#">Обзор товара</a>
                     <div class="subproduct__img">
                        <picture><source srcset="<?= PATH ?>/assets/img/news/img_1.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/news/img_1.png" alt="" class="subproduct__img-img"></picture>
                     </div>
                     <div class="subproduct__text">Термостатический клапан
                        ГЕРЦ-TS-99-FV проходной</div>
                     <div class="subproduct__price">Цена по запросу</div>
                     <div class="subproduct__card card-btn">
                        <button type="button" class="card-btn__btn add-to-card">
                           <span class="icon-cart"></span>
                           В корзину
                        </button>
                        <div id="input-col" class="card-btn__input">
                           <span id="input-min" class="card-btn__input-min">-</span>
                           <input id="input-num" type="number" name="number" min="1" value="1" class="card-num">
                           <span id="input-plus" class="card-btn__input-plus">+</span>
                        </div>
                     </div>
                  </div>
                  <div class="subproduct__item">
                     <div class="subproduct__icons">
                        <span class="subproduct__icon icon-like"></span>
                        <span class="subproduct__icon icon-graph"></span>
                     </div>
                     <a class="subproduct__btn" href="#">Обзор товара</a>
                     <div class="subproduct__img">
                        <picture><source srcset="<?= PATH ?>/assets/img/news/img_1.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/news/img_1.png" alt="" class="subproduct__img-img"></picture>
                     </div>
                     <div class="subproduct__text">Термостатический клапан
                        ГЕРЦ-TS-99-FV проходной</div>
                     <div class="subproduct__price">Цена по запросу</div>
                     <div class="subproduct__card card-btn">
                        <button type="button" class="card-btn__btn">
                           <span class="icon-cart"></span>
                           В корзину
                        </button>
                        <div id="input-col" class="card-btn__input">
                           <span class="card-btn__input-min">-</span>
                           <input type="number" name="number" min="1" value="1" class="card-num">
                           <span class="card-btn__input-plus">+</span>
                        </div>
                     </div>
                  </div>
                  <div class="subproduct__item">
                     <div class="subproduct__icons">
                        <span class="subproduct__icon icon-like"></span>
                        <span class="subproduct__icon icon-graph"></span>
                     </div>
                     <a class="subproduct__btn" href="#">Обзор товара</a>
                     <div class="subproduct__img">
                        <picture><source srcset="<?= PATH ?>/assets/img/news/img_1.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/news/img_1.png" alt="" class="subproduct__img-img"></picture>
                     </div>
                     <div class="subproduct__text">Термостатический клапан
                        ГЕРЦ-TS-99-FV проходной</div>
                     <div class="subproduct__price">Цена по запросу</div>
                     <div class="subproduct__card card-btn">
                        <a href="" class="card-btn__btn">
                           <span class="icon-cart"></span>
                           В корзину
                        </a>
                        <div class="card-btn__input">
                           <span class="card-btn__input-min">-</span>
                           <input type="number" name="number" min="1" value="1" class="card-num">
                           <span class="card-btn__input-plus">+</span>
                        </div>
                     </div>
                  </div>
                  <div class="subproduct__item">
                     <div class="subproduct__icons">
                        <span class="subproduct__icon icon-like"></span>
                        <span class="subproduct__icon icon-graph"></span>
                     </div>
                     <a class="subproduct__btn" href="#">Обзор товара</a>
                     <div class="subproduct__img">
                        <picture><source srcset="<?= PATH ?>/assets/img/news/img_1.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/news/img_1.png" alt="" class="subproduct__img-img"></picture>
                     </div>
                     <div class="subproduct__text">Термостатический клапан
                        ГЕРЦ-TS-99-FV проходной</div>
                     <div class="subproduct__price">Цена по запросу</div>
                     <div class="subproduct__card card-btn">
                        <button type="button" class="card-btn__btn">
                           <span class="icon-cart"></span>
                           В корзину
                        </button>
                        <div id="input-col" class="card-btn__input">
                           <span class="card-btn__input-min">-</span>
                           <input type="number" name="number" min="1" value="1" class="card-num">
                           <span class="card-btn__input-plus">+</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section> -->

         <!-- Блок Вопросы-Ответы -->
         <?= \app\widgets\FaqWidget::render('product', $product['id']) ?>

      </main>
