<?php
namespace app\models;

use RedBeanPHP\R;
use shop\App;

class Subcatalog extends AppModel
{
   public function get_catalog($slug): array
   {
      return R::getAll("SELECT * FROM category WHERE status = 1 AND slug = ?", [$slug]);
   }

   public function get_subcatalog($id): array
   {
      return R::getAll("SELECT * FROM category WHERE status = 1 AND parent_id = ?", [$id]);
   }
   public function get_brand(): array
   {
      return R::getAll("SELECT * FROM brand WHERE status = 1");
   }
}