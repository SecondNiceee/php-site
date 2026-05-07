<?php
namespace app\models;

use RedBeanPHP\R;

class Main extends AppModel
{
   public function get_popular($table,$limit): array
   {
      return R::getAll("SELECT * FROM $table WHERE status = 1 AND popular = 1 LIMIT $limit");
   }

   public function get_products(): array
    {
        return R::getAll("SELECT img, title, slug FROM product WHERE status = 1 ORDER BY id DESC LIMIT 4");
    }
}