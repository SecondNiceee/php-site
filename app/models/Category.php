<?php 

namespace app\models;

use RedBeanPHP\R;
use shop\App;

class Category extends AppModel
{
   public function get_category($slug): array
   {
      return R::getRow("SELECT * FROM category WHERE status = 1 AND slug = ?", [$slug]);
   }
   public function get_sub_catalog($parent_id): array
   {
      return R::getRow("SELECT title, slug FROM category WHERE status = 1 AND id = ?", [$parent_id]);
   }
   public function get_brand(): array
   {
      return R::getAll("SELECT * FROM brand WHERE status = 1");
   }
   
   public function getIds($id): string
      {
         $categories = App::$app->getProperty("categories");
         $ids = '';
         foreach ($categories as $k => $v) {
            if ($v['parent_id'] == $id) {
                $ids .= $k . ',';
                $ids .= $this->getIds($k);
            }
         }
        return $ids;
      }

   public function get_products($ids, $start, $perpage, $get_brand): array
   {
      if($get_brand == 0) {
         $get_brands = '';
      } else {
         $get_brands = "AND brand_id = $get_brand";
      }
      
      return R::getAll("SELECT * FROM product WHERE status = 1 $get_brands AND category_id IN ($ids) LIMIT $start, $perpage");
      
   }
   public function get_product_brand($ids)
   {
      return R::getAll("SELECT brand_id FROM product WHERE status = 1 AND category_id IN ($ids)");
   }
   public function get_products_info($id)
   {
      return R::getAll("SELECT info_key, info_val FROM product_info WHERE product_id = ?", [$id]);
   }
    
   public function get_count_products($ids, $get_brand)
   {
      if($get_brand == 0) {
         $get_brands = '';
      } else {
         $get_brands = "AND brand_id = $get_brand";
      }
      return R::count('product', "category_id IN ($ids) AND status = 1 $get_brands");
   }
}