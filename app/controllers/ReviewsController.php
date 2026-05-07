<?php
namespace app\controllers;

use app\models\Reviews;
use shop\App;

class ReviewsController extends AppController
{
   public function viewAction() 
   {
      $reviews = $this->model->get_reviews();

      $this->setMeta('Отзывы', 'description', 'keywords');
      $this->set(compact('reviews'));

      if (!empty($_POST)) {
         if($this->model->save_review()) {
            return true;
         } else {
            return false;
         }   
      }
   }

}