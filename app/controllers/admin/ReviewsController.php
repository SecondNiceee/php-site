<?php


namespace app\controllers\admin;


use app\models\admin\Reviews;
use RedBeanPHP\R;
use shop\App;

/** @property Reviews $model */
class ReviewsController extends AppController
{

    public function indexAction()
    {
        $reviews = get('reviews');

        $reviews = $this->model->get_reviews();
        $title = 'Список отзывов';
        $this->setMeta("$title");
        $this->set(compact('title', 'reviews'));
    }

    public function deleteAction()
    {
        $id = get('id');
        if ($this->model->deleteReview($id)) {
            $_SESSION['success'] = 'Отзыв удален';
        } else {
            $_SESSION['errors'] = 'Ошибка удаления отзыва';
        }
        redirect();
    }

    public function editAction()
    {
        $id = get('id');

        if (!empty($_POST)) {
            if ($this->model->update_review($id)) {
               $_SESSION['success'] = 'Ответ сохранен';
            } else {
               $_SESSION['errors'] = 'Ошибка сохранения ответа';
            }
            redirect();
        }

        $review = $this->model->get_review($id);
        if (!$review) {
            throw new \Exception('Not found review', 404);
        }
        $title = 'Ответ на отзыв';
        $this->setMeta($title);
        $this->set(compact('title', 'review'));
    }

}