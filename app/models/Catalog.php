<?php
namespace app\models;

use RedBeanPHP\R;
use shop\App;

class Catalog extends AppModel
{
   public function get_catalog(): array
   {
      return R::getAll("SELECT * FROM category WHERE status = 1 AND parent_id = 0");
   }
   public function get_subcatalog(): array
   {
      return R::getAll("SELECT * FROM category WHERE status = 1 AND parent_id != 0");
   }
   public function get_brand(): array
   {
      return R::getAll("SELECT * FROM brand WHERE status = 1");
   }
}