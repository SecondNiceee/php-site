<main class="page">
         <section class="crumbs">
            <div class="crumbs__container">
               <div class="crumbs__contant"><?= $breadcrumbs?></div>
            </div>
         </section>
         <section class="subcatalog">
            <div class="subcatalog__container">
               <div class="subcatalog__title">
                  <h4><?=$catalog[0]['title']?></h4>
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
            </div>
         </section>

      </main>