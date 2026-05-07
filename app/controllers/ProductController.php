<?php 

namespace app\controllers;

use app\models\Breadcrumbs;
use app\models\Product; 
use shop\App;

class ProductController extends AppController
{
   public function viewAction()
   {
      $product = $this->model->get_product($this->route['slug']);
      $product_info = $this->model->get_product_info($product['id']);
      
      if(!$product) {
          if (!DEBUG) {
            $this->error_404();
            return;
         }
        throw new \Exception("Товар по запросу {$this->route['slug']} не найден", 404);
         
      } 

      $breadcrumbs = Breadcrumbs::getBreadcrumbs($product['category_id'], $product['title'], $product['slug']);

      $this->set(compact('product', 'product_info', 'breadcrumbs'));
      $this->setMeta($product['title'], $product['description'], $product['keywords']);
   }
}