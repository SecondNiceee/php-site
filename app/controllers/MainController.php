<?php
namespace app\controllers;

use app\models\Main;
use RedBeanPHP\R;
use shop\Cache;

class MainController extends AppController
{
   public function indexAction() {
      $slides = R::findAll('slider');
      $categorys = $this->model->get_popular('category', 6);
      $brands = $this->model->get_popular('brand', 10000);
      $reviews = R::findAll('reviews');
      $products = $this->model->get_products();

      $this->set(compact('slides', 'categorys', 'brands', 'reviews', 'products'));

      $this->setMeta('Главная страница', 'description', 'keywords');
   }
}