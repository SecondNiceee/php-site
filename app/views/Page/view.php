<main class="page">
         <section class="crumbs">
            <div class="crumbs__container">
               <div class="crumbs__contant"><a class="crumbs__link" href="<?=PATH?>">Главная страница</a>
                  &nbsp;&nbsp;/&nbsp;&nbsp; <a><?=$page['title']?></a>
               </div>
            </div>
         </section>
         <style>
            .cooperation {
               margin-bottom: 60px;
            }
            .cooperation h2 {
               font-weight: 700;
               font-size: 24px;
               margin-bottom: 15px;
               color: #082a43;
            }
            .cooperation p {
               font-weight: 300;
               line-height: 18px;
               margin-bottom: 20px;
               max-width: 670px;
            }
            .cooperation ul li {
               max-width: 670px;
               list-style-type: disc;
               font-weight: 500;
               font-size: 18px;
               margin-bottom: 10px;
            }
         </style>
         <section class="cooperation">
            <div class="cooperation__container">
               <?=$page['content'];?>

            </div>
         </section>
      </main>