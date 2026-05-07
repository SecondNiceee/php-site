<?php
namespace app\controllers;

use app\models\admin\Brand;
use app\models\Breadcrumbs;
use shop\App;
use shop\Pagination;

class BrandController extends AppController
{
   public function viewAction()
   {
      $brand = $this->model->get_brand_by_slug($this->route['slug']);
      
      if(!$brand){
         if (!DEBUG) {
            $this->error_404();
            return;
         }
        throw new \Exception("Бренд по запросу {$this->route['slug']} не найден", 404);
      }
      
      //Pagination
      $page = get('page');
      $perpage = App::$app->getProperty('pagination');
      $total = $this->model->get_count_products_by_brand($brand['id']);
      $pagination = new Pagination($page, $perpage, $total);
      $start = $pagination->getStart();
      //Pagination
      
      $products = $this->model->get_products_by_brand($brand['id'], $start, $perpage);
      
      foreach ($products as $product) {
         $product['product_info'] = $this->model->get_products_info($product['id']) ? $this->model->get_products_info($product['id']) : '' ;
         $products_arr[] = $product;
      }

      $this->setMeta($brand['title'], $brand['description'] ?? '', $brand['keywords'] ?? '');
      $this->set(compact('brand', 'products_arr', 'total', 'pagination'));
   }
}
