<?php

namespace app\models;

use RedBeanPHP\R;

class Search extends AppModel
{
   public function get_count_find_products($s): int
   {
      return R::getCell("SELECT COUNT(*) FROM product WHERE status = 1 AND title LIKE ?", ["%{$s}%"]);
   }

   public function get_find_products($s, $start, $parpage): array
   {
      return R:: getAll("SELECT * FROM product WHERE status = 1 AND title LIKE ? LIMIT $start, $parpage", ["%{$s}%"]);
   }
   public function get_products_info($id)
   {
      return R::getAll("SELECT info_key, info_val FROM product_info WHERE product_id = ?", [$id]);
   }
}