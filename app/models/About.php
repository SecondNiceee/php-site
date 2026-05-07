<?php
namespace app\models;

use RedBeanPHP\R;
use shop\App;

class About extends AppModel
{
   public function get_about(): array
   {
      return R::getRow("SELECT * FROM about");
   }
   public function get_team(): array
   {
      return R::getAll("SELECT * FROM team");
   }
}