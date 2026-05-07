<script src="/ckfinder/ckfinder.js"></script>

<main class="page">
         <section class="crumbs">
            <div class="crumbs__container">
               <div class="crumbs__contant"><a class="crumbs__link" href="#">Главная страница</a>
                  &nbsp;&nbsp;/&nbsp;&nbsp; <a>Отзывы</a> 
               </div>
            </div>
         </section>
         
         <section class="reviews">
            <div class="reviews__container">
               <div class="reviews__title">
                  <h4>Отзывы</h4>
               </div>
               <?php if(!empty($reviews)) :?>
               <div class="reviews__items">
                  <?php foreach($reviews as $review):?>
                  <div class="reviews__item">
                     <div class="reviews__header">
                        <div class="reviews__icon">
                           <img src="<?= PATH ?>/assets/img/icons/reviews.png" alt="">
                        </div>
                        <div class="reviews__header-body">
                           <div class="reviews__subtitle"><?=$review['title']?></div>
                           <div class="reviews__date"><?=date("d.m.Y", strtotime($review['date']));?></div>
                        </div>
                     </div>
                     <div class="reviews__text"><?=$review['text']?></div>
                     <div class="reviews__autor">
                        <div class="reviews__name"><?=$review['name']?></div>
                        <div class="reviews__prof"><?=$review['job']?></div>
                     </div>
                     <?php if($review['answer'] != NULL) :?>
                     <div class="reviews__answer">
                        <div class="reviews__answer-title">Ответ</div>
                        <div class="reviews__answer-text"><?=$review['answer']?></div>
                     </div>
                     <?php endif; ?>
                  </div>
                  <?php endforeach;?>
               </div>
               <?php endif; ?>
               <a href="#popup-reviews" class="reviews__btn popup-link">Оставить отзыв</a>
            </div>
         </section>

      </main>
      <div id="popup-reviews" class="popup-reviews popup">
      <div class="popup-reviews__body">
         <a href="" class="popup-reviews__close close-popup"></a>
         <div class="popup-reviews__contant no-close">
            <div class="reviews__title">Оставить отзыв</div>
            <form class="reviews__form">
               <input type="text" name="company" id="reviewCompany" placeholder="Компания">
               <input type="text" name="name" id="reviewName" placeholder="Ваше имя">
               <input type="text" name="job" id="reviewJob" placeholder="Ваша должность">
               <div class="card mb-3">
                  <div class="card-body ">
                     <div id="base-img-output" class="upload-images base-image mb-2"></div>
                     <div class="small font-italic text-muted mb-4">JPG или PNG</div>
                     <button class="btn btn-primary" id="add-base-img" onclick="popupBaseImage(); return false;" type="button">Загрузить логотип</button>
                  </div>
               </div>
               <textarea name="message" id="reviewMessage" rows="5" placeholder="Отзыв"></textarea>
               <button type="submit" style="margin:0;" id="reviews-run" class="reviews__btn">Оставить отзыв</button>
            </form>
         </div>
      </div>
   </div>

   <script>
      function popupBaseImage() {
         CKFinder.popup( {
            chooseFiles: true,
            onInit: function( finder ) {
               finder.on( 'files:choose', function( evt ) {
                  var file = evt.data.files.first();
                  const baseImgOutput = document.getElementById( 'base-img-output' );
                  baseImgOutput.innerHTML = '<div class="product-img-upload"><img style="max-width: 400px;" src="' + file.getUrl() + '"><input type="hidden" name="img" id="reviewImg" value="' + file.getUrl() + '"><a style="margin-left:20px;" class="del-img btn btn-danger btn-lg"><i class="far fa-trash-alt"></i></a></div>';
               } );
               finder.on( 'file:choose:resizedImage', function( evt ) {
                  const baseImgOutput = document.getElementById( 'base-img-output' );
                  baseImgOutput.innerHTML = '<div class="product-img-upload"><img style="max-width: 400px;" src="' + evt.data.resizedUrl + '"><input type="hidden" name="img" id="reviewImg" value="' + evt.data.resizedUrl + '"><a style="margin-left:20px;" class="del-img btn btn-danger btn-lg"><i class="far fa-trash-alt"></i></a></div>';
               } );
            }
         } );
      }
                           
   </script>