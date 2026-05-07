<?php
namespace app\models;

use RedBeanPHP\R;
use shop\App;

class Reviews extends AppModel
{
   public function get_reviews(): array
   {
      return R::getAll("SELECT * FROM reviews ORDER BY date DESC");
   }
   public function save_review()
   {
      R::begin();
      try {
          $review = R::dispense('reviews');
          $review->title = h(post('company'));
          $review->img = post('img') ?: NO_IMAGE;
          $review->text = h(post('message'));
          $review->name = h(post('name'));
          $review->job = h(post('job'));
          R::store($review);
          R::commit();
          return true;
      } catch (\Exception $e) {
          R::rollback();
          debug($e, 1);
          return false;
      }
   }
}