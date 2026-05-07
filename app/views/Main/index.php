<main class="page">
         <section class="main">
            <div class="main__container">
               <?php if(!empty($slides)) : ?>
               <div class="main__slider slider">
                  <div id="main__slider" class="swiper">
                     <div class="swiper-wrapper">
                        <?php foreach($slides as $slide) : ?>
                        <div class="swiper-slide slider__slide">
                           <h2 class="slider__title"><?=$slide->title;?></h2>
                           <div class="slider__text"><?=$slide->description;?></div>
                           <a href="#" class="slider__btn">
                              Скачать прайс <picture><source srcset="<?= PATH ?>/assets/img/icons/pdf.webp" type="image/webp"><img class="slider__btn-img" src="<?= PATH ?>/assets/img/icons/pdf.png" alt="pdf"></picture>
                           </a>
                           <div class="slider__img">
                              <img class="slider__img-img" src="<?= PATH . $slide->img ?>" alt="">
                           </div>
                        </div>
                        <?php endforeach;?>
                     </div>

                     <div class="swiper-pagination"></div>
                     <div class="swiper-button-prev"></div>
                     <div class="swiper-button-next"></div>

                  </div>
               </div>
               <?php endif; ?>
               <div class="main__baner main-baner">
                  <a href="#" class="main-baner__link">
                     <div class="main-baner__contant">
                        <div class="main-baner__title">Официальный дистрибьютер</div>
                        <picture><source srcset="<?= PATH ?>/assets/img/baner/main-baner__logo.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/baner/main-baner__logo.png" alt="" class="main-baner__logo"></picture>
                        <picture><source srcset="<?= PATH ?>/assets/img/baner/main-baner__img-1.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/baner/main-baner__img-1.jpg" alt="" class="main-baner__img-1"></picture>
                        <picture><source srcset="<?= PATH ?>/assets/img/baner/main-baner__img-2.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/baner/main-baner__img-2.png" alt="" class="main-baner__img-2"></picture>
                        <picture><source srcset="<?= PATH ?>/assets/img/baner/main-baner__img-3.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/baner/main-baner__img-3.png" alt="" class="main-baner__img-3"></picture>
                     </div>
                  </a>
               </div>
            </div>
         </section>
         <?php if(!empty($categorys)) :?>
         <section class="popular-cat">
            <div class="popular-cat__container">
               <div class="popular-cat__title">
                  <h4>Популярные категории</h4>
               </div>
               <a href="/catalog" class="popular-cat__link red-link">Все категории <span
                     class="icon-arrow"></span></a>
               <div class="popular-cat__contant">
                  <?php foreach($categorys as $category) :?>
                  <div class="popular-cat__item kat-item">
                     <div class="kat-item__contant">
                        <div class="kat-item__title">
                           <h6><?=$category['title']?></h6>
                        </div>
                        <div class="kat-item__price">от <?=$category['price']?> руб</div>
                        <a href="subcatalog/<?=$category['slug']?>" class="kat-item__link">Перейти в раздел</a>
                     </div>
                     <div class="kat-item__img">
                        <img src="<?= PATH . $category['img']?>" alt="" class="kat-item__img-img">
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <?php endif;?>
         <?php if(!empty($brands)) :?>
         <section class="popular-brand">
            <div class="popular-brand__container">
               <div class="popular-brand__title">
                  <h4>Популярные бренды</h4>
               </div>
               <div class="popular-brand__contant">
                  <div class="swiper popular-brand__slider">
                     <div class="swiper-wrapper popular-brand__wrapper">
                        <?php foreach($brands as $brand) :?>
                        <div class="swiper-slide popular-brand__slide">
                           <img class="popular-brand__img" src="<?= PATH . $brand['img']?>" alt="">
                        </div>
                        <?php endforeach;?>
                     </div>


                  </div>
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
               </div>
            </div>
         </section>
         <?php endif; ?>
         <section class="baners">
            <div class="baners__container">
               <div class="baners__banner-big big-baner">
                  <div class="big-baner__contant">
                     <div class="big-baner__title">Термостатические головки </div>
                     <div class="big-baner__name">HERZ DE LUXE</div>
                     <div class="big-baner__benefit">выгода до 30%</div>
                     <div class="big-baner__benefit-text">при покупке от 20 комплетов</div>
                  </div>
                  <picture><source srcset="<?= PATH ?>/assets/img/baner/baners_img_1.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/baner/baners_img_1.png" alt="" class="big-baner__img"></picture>
               </div>
               <div class="baners__item">
                  <div class="baners__banner"></div>
                  <div class="baners__banner"></div>
                  <div class="baners__banner"></div>
               </div>
            </div>
         </section>
         <?php if(!empty($products)): ?>
         <section class="news">
            <div class="news__container">
               <div class="news__title">
                  <h4>Обзоры новинок</h4>
               </div>
               <div class="news__contant">
                  <?php foreach($products as $product) :?>
                  <div class="news__item new">
                     <img src="<?= PATH . $product['img']?>" alt="" class="new__img">
                     <div class="new__text"><?=$product['title']?></div>
                     <a href="/product/<?=$product['slug']?>" class="new__link">Перейти в раздел</a>
                  </div>
                  <?php endforeach;?>
               </div>
            </div>
         </section>
         <?php endif;?>
         <section class="partners">
            <div class="partners__container">
               <div class="partners__title">
                  <h4>Более 1500 партнеров по всей России</h4>
               </div>
               <div class="partners__text">Приглашаем к сотрудничеству строительные и монтажные организации, магазины и
                  частных мастеров</div>
               <div class="partners__items benefits">
                  <div class="benefits__item">
                     <div class="benefits__img">
                        <img src="<?= PATH ?>/assets/img/benefits/img_1.png" alt="" class="benefits__img-img">
                     </div>
                     <div class="benefits__contant">
                        <div class="benefits__title">
                           <h6>Прямые поставки от производителей </h6>
                        </div>
                        <div class="benefits__text">Работаем напрямую с производителями, подбор комплектующих инженерами
                           со
                           стажем более 10 лет</div>
                     </div>
                  </div>
                  <div class="benefits__item">
                     <div class="benefits__img">
                        <picture><source srcset="<?= PATH ?>/assets/img/benefits/img_2.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/benefits/img_2.png" alt="" class="benefits__img-img"></picture>
                     </div>
                     <div class="benefits__contant">
                        <div class="benefits__title">
                           <h6>Оперативная доставка по всей России </h6>
                        </div>
                        <div class="benefits__text">Бесплатная доставка по Москве, Московской области и до терминала
                           любой
                           ТК в течение 24 часов с момента заказа</div>
                     </div>
                  </div>
                  <div class="benefits__item">
                     <div class="benefits__img">
                        <picture><source srcset="<?= PATH ?>/assets/img/benefits/img_3.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/benefits/img_3.png" alt="" class="benefits__img-img"></picture>
                     </div>
                     <div class="benefits__contant">
                        <div class="benefits__title">
                           <h6>Гибкая система скидок </h6>
                        </div>
                        <div class="benefits__text">Специальные цены постоянным клиентам и партнерам
                           лучшее соотношение “цена-качество”</div>
                     </div>
                  </div>
                  <div class="benefits__item">
                     <div class="benefits__img">
                        <picture><source srcset="<?= PATH ?>/assets/img/benefits/img_4.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/benefits/img_4.png" alt="" class="benefits__img-img"></picture>
                     </div>
                     <div class="benefits__contant">
                        <div class="benefits__title">
                           <h6>В наличии на собственном складе </h6>
                        </div>
                        <div class="benefits__text">В наличии на складе более 128 350 позиций и возможность выбора
                           оборудования из нескольких ценовых категорий </div>
                     </div>
                  </div>
                  <div class="benefits__item">
                     <div class="benefits__img">
                        <picture><source srcset="<?= PATH ?>/assets/img/benefits/img_5.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/benefits/img_5.png" alt="" class="benefits__img-img"></picture>
                     </div>
                     <div class="benefits__contant">
                        <div class="benefits__title">
                           <h6>Удобные способы оплаты</h6>
                        </div>
                        <div class="benefits__text">Специальные цены постоянным клиентам и партнерам лучшее соотношение
                           “цена-качество”</div>
                     </div>
                  </div>
                  <div class="benefits__item">
                     <div class="benefits__img">
                        <picture><source srcset="<?= PATH ?>/assets/img/benefits/img_6.webp" type="image/webp"><img src="<?= PATH ?>/assets/img/benefits/img_6.png" alt="" class="benefits__img-img"></picture>
                     </div>
                     <div class="benefits__contant">
                        <div class="benefits__title">
                           <h6>Гарантия качества до 50 лет</h6>
                        </div>
                        <div class="benefits__text">Гарантия качества от 18 месяцев до 50 лет</div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <section class="delivery">
            <div class="delivery__container">
               <div class="delivery__title">
                  <h4>Трубопроводная арматура с доставкой по всей России </h4>
               </div>
               <div class="delivery__text">
                  <p>За время нашей работы, поставленное нами оборудование успешно функционирует более чем на 150
                     объектах,от небольших ИТП до предприятий отраслеобразующих энергетических компаний России.
                     География наших поставок простирается от Республики Крым до Владивостока.</p>
                  <p>За время нашей работы, поставленное нами оборудование успешно функционирует более чем на 150
                     объектах,от небольших ИТП до предприятий отраслеобразующих энергетических компаний России.
                  </p>
                  <p>География наших поставок простирается от Республики Крым до Владивостока.</p>
               </div>
            </div>
         </section>
         <?php if (!empty($reviews)):?>
         <section class="reviews">
            <div class="reviews__container">
               <div class="reviews__title">
                  <h4>Отзывы наших партнеров</h4>
               </div>
               <div class="reviews__text">Нашими клиентами являются строительно-монтажные компании, ЖКХ, коммерческие
                  организации, предприятия нефтегазовой, химической и пищевой промышленности.</div>
               <a href="/reviews" class="reviews__link red-link">Все отзывы <span class="icon-arrow"></span></a>
               <div class="slider-reviews">
                  <div id="slider-reviews" class="swiper">
                     <div class="swiper-wrapper">
                        <?php foreach($reviews as $review) :?>
                        <div class="swiper-slide slider-reviews__slide">
                           <div class="slider-reviews__body">
                              <div class="slider-reviews__img">
                                 <img src="<?= PATH . $review['img']?>" alt="" class="slider-reviews__img-img">
                              </div>
                              <div class="slider-reviews__contant">
                                 <div class="slider-reviews__text"><?=$review['text']?></div>
                                 <div class="slider-reviews__autor">
                                    <div class="slider-reviews__name"><?=$review['name']?></div>
                                    <div class="slider-reviews__job"><?=$review['job']?></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
                  <div class="swiper-button-prev"></div>
                  <div class="swiper-button-next"></div>
               </div>
            </div>
         </section>
         <?php endif; ?>

         <!-- Блок Вопросы-Ответы -->
         <?= \app\widgets\FaqWidget::render('main', 0) ?>

      </main>