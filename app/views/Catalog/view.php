<main class="page">
         <section class="crumbs">
            <div class="crumbs__container">
               <div class="crumbs__contant">
               <?= $breadcrumbs?>
               </div>
            </div>
         </section>
         <?php if(!empty($catalog)) :?>
         <section class="catalogpage">
            <div class="catalogpagepage__container">
               <div class="catalogpagepage__title">
                  <h4>Каталог продукции</h4>
               </div>
               <div class="catalogpage__items">
                  <?php foreach($catalog as $item) :?>
                  <div class="catalogpage__item item-catalogpage">
                     <a href="subcatalog/<?= $item['slug'] ?>" class="item-catalogpage__baner catalogpage-baner">
                        <div class="catalogpage-baner__title"><?= $item['title'] ?> <span class="icon-arrow"></span>
                        </div>
                        <img src="<?= PATH . $item['img'] ?>" alt="" class="catalogpage-baner__img">
                     </a>
                     <div class="item-catalogpage__items">
                     
                        <ul class="item-catalogpage__list">
                        <?php foreach($subcatalog as $val) :?>
                           <?php if($val['parent_id'] == $item['id']): ?>
                              <li class="item-catalogpage__item">
                              <a href="category/<?=$val['slug']?>" class="item-catalogpage__link"><?=$val['title']?> <span
                                    class="icon-arrow"></span></a>
                           </li>
                           <?php endif;?>
                        <?php endforeach;?>
                        </ul>
                     
                     </div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <?php endif; ?>
      </main>