<?php 
namespace app\controllers;

use app\models\AppModel;
use shop\Controller;
use RedBeanPHP\R;
use shop\App;

class AppController extends Controller
{
   public function __construct($route)
   {
      parent::__construct($route);
      new AppModel();

      $categories = R::getAssoc("SELECT * FROM category");
      App::$app->setProperty("categories", $categories);
   }
}