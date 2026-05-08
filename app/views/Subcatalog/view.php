<main class="page">
         <section class="crumbs">
            <div class="crumbs__container">
               <div class="crumbs__contant"><?= $breadcrumbs?></div>
            </div>
         </section>
         <section class="subcatalog">
            <div class="subcatalog__container">
               <div class="subcatalog__title">
                  <h1 style="font-weight: 700; font-size: 24px; margin-bottom: 15px;"><?=$category['title']?></h1>
               </div>
               <?php if(isset($subcatalog)):?>
               <div class="subcatalog__items">
                  <?php foreach($subcatalog as $item):?>
                  <a href="category/<?= $item['slug'] ?>" class="subcatalog__item subcatalog-baner">
                     <div class="subcatalog-baner__title"><?=$item['title']?></div>
                     <div class="subcatalog-baner__img">
                        <img src="<?=PATH . $item['img']?>" alt="" class="subcatalog-baner__img-img">
                     </div>
                  </a>
                  <?php endforeach;?>
               </div>
               <?php endif; ?>

               <?php if(!empty($category['content'])): ?>
               <div class="subcatalog__description mt-4">
                  <?=$category['content']?>
               </div>
               <style>
                  .subcatalog__description {
                     font-weight: 300;
                     font-size: 16px;
                     color: #082a43;
                     line-height: 1.6;
                     margin-bottom: 30px;
                     padding: 25px;
                     background: linear-gradient(268.34deg,#f3f8fb 5.64%,#fdfdfd 98.88%);
                     border: 1px solid #f6f6f6;
                     border-radius: 5px;
                  }
                  .subcatalog__description p { margin-bottom: 15px; }
                  .subcatalog__description p:last-child { margin-bottom: 0; }
                  .subcatalog__description h2,
                  .subcatalog__description h3,
                  .subcatalog__description h4,
                  .subcatalog__description h5,
                  .subcatalog__description h6 { font-weight: 700; margin-bottom: 15px; margin-top: 25px; color: #082a43; }
                  .subcatalog__description h2:first-child,
                  .subcatalog__description h3:first-child,
                  .subcatalog__description h4:first-child { margin-top: 0; }
                  .subcatalog__description ul,
                  .subcatalog__description ol { margin-bottom: 15px; padding-left: 25px; }
                  .subcatalog__description li { margin-bottom: 8px; }
                  .subcatalog__description a { color: #2f72cf; text-decoration: none; transition: all .3s; }
                  .subcatalog__description a:hover { color: #082a43; }
                  .subcatalog__description img { max-width: 100%; height: auto; border-radius: 5px; margin: 15px 0; }
                  @media (max-width: 767.98px) {
                     .subcatalog__description { font-size: 14px; padding: 15px; }
                  }
                  @media (max-width: 479.98px) {
                     .subcatalog__description { padding: 12px; font-size: 13px; }
                  }
               </style>
               <?php endif; ?>
            </div>
         </section>

      </main>
