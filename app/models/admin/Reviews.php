<?php


namespace app\models\admin;


use app\models\AppModel;
use RedBeanPHP\R;
use shop\App;

class Reviews extends AppModel
{

    public function get_reviews(): array
    {
        return R::getAll("SELECT * FROM reviews ORDER BY id DESC");
    }

    public function deleteReview($id): bool
    {
        R::begin();
        try {
            $review = R::load('reviews', $id);
            if (!$review) {
                return false;
            }
            R::trash($review);
            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }

    public function update_review($id): bool
    {
        R::begin();
        try {
            // page
            $review = R::load('reviews', $id);
            if (!$review) {
                return false;
            }
           
            R::exec("UPDATE reviews SET answer = ? WHERE id = ?", [
               $_POST['answer'],
               $id,
            ]);
            

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }

    public function get_review($id): array
    {
        return R::getRow("SELECT * FROM reviews WHERE id = ?", [$id]);
    }

}