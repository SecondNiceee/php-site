<?php
namespace app\controllers;

use app\models\About;
use shop\App;

class AboutController extends AppController
{
   public function viewAction() 
   {
      $about = $this->model->get_about();
      $teams = $this->model->get_team();

      $this->setMeta($about['title'], 'description', 'keywords');
      $this->set(compact('about', 'teams'));
   }
}