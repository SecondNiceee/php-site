<?php
      use shop\View;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
   <base href="/">
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <style>
     body {
      opacity: 0;
      transition: opacity 0.5s ease 0s;
     }
   </style>
   <link rel="stylesheet" href="/assets/css/style.min.css?-v=20221018171731">
   <?=$this->getMeta();?>
   
</head>

<body>
   <div class="preloader" id="preloader">
      <div class="preloader-5"></div>
   </div>
   <div class="wrapper">
      <header class="header">
         <div class="header__container">
            <div class="header__top">
               <div class="header__logo-contant">
                  <a href="" class="header__logo"><picture><source srcset="/assets/img/logo.webp" type="image/webp"><img src="/assets/img/logo.png" alt=""></picture></a>
                  <div class="header__description">
                     Трубопроводная арматура,
                     фитинги и металлопрокат
                  </div>
               </div>
               <div data-da=".header__bottom,992,1" class="header__menu menu">
                  <nav class="menu__body">
                     <?php
                        new \app\widgets\page\Page([
                           'class' => 'menu__list',
                           'menu' => 'top',
                           'prepend' => '
                                 <li class="menu__item"><a href="/" class="menu__link">Главная</a></li>
                                 <li class="menu__item"><a href="/about" class="menu__link">О компании</a></li>
                                 <li class="menu__item"><a href="/review" class="menu__link">Отзывы</a></li>
                           ',
                        ]);
                     ?>
                  </nav>
               </div>
               <button type="button" class="header__burger">
                  <span></span>
               </button>
               <div data-da=".header__bottom,992,last" class="header__adres">
                  <span>Адрес: </span>
                  Москва, улица Талдомская, 2г
               </div>
            </div>
            <div class="header__bottom">
               <a href="#popup_catalog" class="header__btn popup-link"><span class="icon-catalog"></span>
                  Каталог товаров</a>
               <div class="header__info">
                  пн-сб: с 08:00 до 20:00
                  <span>+7 (499) 394-48-93</span>
               </div>
               <div class="header__mail">
                  potokllc@gmail.com
                  <a href="#popup-coll" class="header__mail-btn popup-link"><span class="icon-tel"></span> Заказать звонок</a>
               </div>
               <div class="header__search search">
                  <form action="search">
                     <input type="search" name="search" id="header-search" placeholder="Поиск по сайту">
                     <button type="submit">
                        <picture><source srcset="/assets/img/icons/search.webp" type="image/webp"><img class="search__img" src="/assets/img/icons/search.png" alt=""></picture>
                     </button>
                  </form>
               </div>
               <a href="#popup-cart" data-da=".header__top, 992, last" class="header__cart popup-link">
                  <div class="header__cart-icon"><?= $_SESSION['cart.qty'] ?? 0; ?></div>
                  <picture><source srcset="/assets/img/icons/cart.webp" type="image/webp"><img class="header__cart-img" src="/assets/img/icons/cart.png" alt=""></picture>
                  Ваша корзина
               </a>
            </div>

            <div class="header__catalog popup" id="popup_catalog">
               <div class="popup__container">
                  <div class="popup__catalog">
                     <div class="popup__body">
                        <a href="#" class="popup__close close-popup"></a>
                        <div class="popup__contant">
                           <h5 class="popup__title">Каталог товаров</h5>
                           <div class="catalog__menu catalog">
                              <nav class="catalog__body">
                              
                                    <?php
                                       new \app\widgets\menu\Menu([
                                                                                
                                       ])
                                    ?>
                              
                              </nav>
                           </div>
                           <a href="#popup-coll" class="popup__btn popup-link">Нужна консультация</a>
                        </div>
                        <div class="search popup__search">
                        <form action="search">
                           <input type="search" name="search" id="header-search" placeholder="Поиск по сайту">
                           <button type="submit">
                              <picture><source srcset="/assets/img/icons/search.webp" type="image/webp"><img class="search__img" src="/assets/img/icons/search.png" alt=""></picture>
                           </button>
                        </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>