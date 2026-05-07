<?php
namespace app\controllers;

use app\models\Category;
use app\models\Breadcrumbs;
use shop\App;
use shop\Pagination;

class CategoryController extends AppController
{
   public function viewAction()
   {
      $category = $this->model->get_category($this->route['slug']);
      $brands = $this->model->get_brand();
      $get_brand = get('brand');
      if(!$category){
         if (!DEBUG) {
            $this->error_404();
            return;
         }
        throw new \Exception("Товар по запросу {$this->route['slug']} не найден", 404);
      }
      
      $breadcrumbs = Breadcrumbs::getBreadcrumbs($category['id']);
      $ids = $this->model->getIds($category['id']);
      $ids = !$ids ? $category['id'] : $ids . $category['id'];

      //Pagination
      $page = get('page');
      $perpage = App::$app->getProperty('pagination');
      $total = $this->model->get_count_products($ids, $get_brand);
      $pagination = new Pagination($page, $perpage, $total);
      $start = $pagination->getStart();
      //Pagination
      

      $prod = $this->model->get_products($ids, $start, $perpage, $get_brand);
      
      if(!$prod){
         if (!DEBUG) {
            $this->error_404();
            return;
         }
        throw new \Exception("Товары по запросу {$this->route['slug']} не найдены", 404);
      }
      
      foreach ($prod as $product) {
         $product['product_info'] = $this->model->get_products_info($product['id']) ? $this->model->get_products_info($product['id']) : '' ;
         $products[] = $product;
      }

      $brands_arr = [];
      $product_brands = $this->model->get_product_brand($ids);
      foreach($product_brands as $pb) {
         foreach($brands as $brand) {
            if($brand['id'] == $pb['brand_id']) {
               if(!in_array($brand['id'], $brands_arr)) {
                  $brands_arr[] =  $brand;
               }
            }
         }
      }
      $brands = array_intersect_key( $brands_arr , array_unique( array_map('serialize' , $brands_arr ) ) );
      
      // Преобразуем ссылки на бренды в ЧПУ формат
      $brands_urls = [];
      foreach($brands as $brand) {
         $brand_slug = R::getRow("SELECT slug FROM brand WHERE id = ?", [$brand['id']]);
         $brand['slug'] = $brand_slug ? $brand_slug['slug'] : '';
         $brands_urls[] = $brand;
      }
      $brands = $brands_urls;
      
      
      $this->setMeta($category['title'], $category['description'], $category['keywords']);
      $this->set(compact('category', 'breadcrumbs', 'products', 'brands', 'total', 'pagination', 'get_brand'));
   }
}