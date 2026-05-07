<main class="page">
         <section class="crumbs">
            <div class="crumbs__container">
               <div class="crumbs__contant"><a class="crumbs__link" href="<?=PATH?>">Главная страница</a>
                  &nbsp;&nbsp;/&nbsp;&nbsp; <a><?=$about['title']?></a>
               </div>
            </div>
         </section>
         <section class="about">
            <div class="about__container">
               <div class="about__title">
                  <h4><?=$about['title']?></h4>
               </div>
               <div class="about__body">
                  <div class="about__text">
                  <?=$about['content']?>
                  </div>
                  <div class="about__img">
                     <img class="about__img-img" src="<?=$about['img']?>" alt="">
                  </div>
               </div>
            </div>
         </section>
         <style>
            .information__tr {
               display: flex;
               justify-content:space-between;
               border-bottom: 1px solid #d3d3d3;
               margin-bottom: 10px;
               padding-bottom: 10px;
            }
            .information__td {
               flex: 1 1 50%;
            }
         </style>
         <section class="information">
            <div class="information__container">
               <div class="information__title">
                  <h4>Учетная карточка</h4>
               </div>
               <div class="information__body">
                  <div class="information__text">
                     <div class="information__table">
                        <div class="information__tr">
                           <div class="information__td">Полное наименование компании</div>
                           <div class="information__td">Общество с ограниченной ответственностью «Поток»</div>
                        </div>
                        <div class="information__tr">
                           <div class="information__td">Сокращенное наименование компании</div>
                           <div class="information__td">ООО «Поток»</div>
                        </div>
                        <div class="information__tr">
                           <div class="information__td">ИНН</div>
                           <div class="information__td">5044099282</div>
                        </div>
                        <div class="information__tr">
                           <div class="information__td">КПП</div>
                           <div class="information__td">504401001</div>
                        </div>
                        <div class="information__tr">
                           <div class="information__td">ОГРН</div>
                           <div class="information__td">1165044052612</div>
                        </div>
                        <div class="information__tr">
                           <div class="information__td">ОКПО</div>
                           <div class="information__td">05126036</div>
                        </div>
                        <div class="information__tr">
                           <div class="information__td">Юридический адрес</div>
                           <div class="information__td">141533, Московская область, Солнечногорский район, дер.Безверхово, д.13</div>
                        </div>
                        <div class="information__tr">
                           <div class="information__td">Банковский счет</div>
                           <div class="information__td">ПАО СБЕРБАНК г. Москва <br>
                            БИК 044525225<br>
                            К/С 30101810400000000225<br>
                            Р/С 40702810838000126027
                            </div>
                        </div>
                        <div class="information__tr">
                           <div class="information__td">Генеральный директор</div>
                           <div class="information__td">Качалова Татьяна Юрьевна</div>
                        </div>
                        <div class="information__tr">
                           <div class="information__td">Главный бухгалтер</div>
                           <div class="information__td">Качалова Татьяна Юрьевна</div>
                        </div>
                        <div class="information__tr">
                           <div class="information__td">Почтовый адрес</div>
                           <div class="information__td">141533, Московская область, Солнечногорский район, дер.Безверхово, д.13 </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <?php if(!empty($teams)) :?>
         <section class="personal">
            <div class="personal__container">
               <div class="personal__title">
                  <h4>Наш коллектив</h4>
               </div>
               <div class="personal__items">
                  <?php foreach($teams as $team) :?>
                  <div class="personal__item">
                     <img src="<?=$team['img']?>" alt="" class="personal__img">
                     <div class="personal__name"><?=$team['name']?></div>
                     <div class="personal__prof"><?=$team['job']?></div>
                  </div>
                  <?php endforeach; ?>
               </div>
            </div>
         </section>
         <?php endif; ?>
      </main>