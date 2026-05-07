<?php 

namespace app\models;

use RedBeanPHP\R;

class Product extends AppModel
{
   public function get_product($slug): array
   {
      return R::getRow("SELECT * FROM product WHERE status = 1 AND slug = ?", [$slug]);
   }
   public function get_product_info($id): array
   {
      return R::getAll("SELECT * FROM product_info WHERE product_id = ?", [$id]);
   }

   
}