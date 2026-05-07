<?php

namespace app\controllers;

use app\models\Search;
use shop\App;
use shop\Pagination;

class SearchController extends AppController 
{
   public function indexAction()
   {
      $s = h(get('search', 's'));
      if($s) {
         $page = get('page');
         $total = $this->model->get_count_find_products($s);
         $parpage = App::$app->getProperty('pagination');
         $pagination = new Pagination($page, $parpage, $total);
         $start = $pagination->getStart();

         $prod = $this->model->get_find_products($s, $start, $parpage);

         foreach ($prod as $product) {
            $product['product_info'] = $this->model->get_products_info($product['id']) ? $this->model->get_products_info($product['id']) : '' ;
            $products[] = $product; 
         }

         $this->setMeta('Поиск');
         $this->set(compact('s', 'products', 'pagination', 'total'));
      } 
      else {
         $this->setMeta('Поиск');
         $this->set(compact('s'));
      }
      
     
   }
}