<?php
namespace app\controllers\admin;

use app\models\admin\Category;
use RedBeanPHP\R;
use shop\App;
use shop\Cache;

class CategoryController extends AppController
{
   public function indexAction()
   {
      $title = 'Категории';
      $this->setMeta('Категории');
      
      $this->set(compact('title'));
   }

   public function deleteAction()
   {
      $id = get('id');
      $errors = '';
      $children = R::count('category', 'parent_id = ?', [$id]);
      $products = R::count('product', 'category_id = ?', [$id]);
      if ($children) {
         $errors .= 'В категории есть вложенные категории.<br>';
      }
      if ($products) {
         $errors .= 'В категории есть товары.<br>';
      }
      if ($errors) {
         $_SESSION['errors'] = $errors;
      } else {
         R::exec("DELETE FROM category WHERE id = ?", [$id]);
         $_SESSION['success'] = 'Категория удалена';
         $cache = Cache::getInstance();
         $cache->delete('shop_menu');
      }
      redirect();
   }
   public function addAction()
   {
      if(!empty($_POST)) {
         if ($this->model->category_validate()) {
            if ($this->model->save_category()) {
               $_SESSION['success'] = 'Категория сохранена';
               $cache = Cache::getInstance();
               $cache->delete('shop_menu');
            } else {
               $_SESSION['errors'] = 'Ошибка!';
            }
         }
         redirect();
      }

      $title = 'Добавить категорию';
      $this->setMeta('Добавить категорию');
      
      $this->set(compact('title'));
   }

   public function editAction()
    {
        $id = get('id');
        if (!empty($_POST)) {
            if ($this->model->category_validate()) {
               if ($this->model->update_category($id)) {
                  $_SESSION['success'] = 'Категория обновлена';
                  $cache = Cache::getInstance();
                  $cache->delete('shop_menu');
               } else {
                  $_SESSION['errors'] = 'Ошибка!';
               }
         }
         redirect();
        }
        $category = $this->model->get_category($id);
        if (!$category) {
            throw new \Exception('Not found category', 404);
        }
        App::$app->setProperty('parent_id', $category['parent_id']);
        $title = 'Редактирование категории';
        $this->setMeta($title);
        $this->set(compact('title', 'category'));
    }

   public function duplicateAction()
   {
      $id = get('id');
      $category = $this->model->get_category($id);
      if (!$category) {
         $_SESSION['errors'] = 'Категория не найдена';
         redirect();
      }
      
      $newId = $this->model->duplicate_category($id);
      if ($newId) {
         $_SESSION['success'] = 'Категория дублирована';
         $cache = Cache::getInstance();
         $cache->delete('shop_menu');
      } else {
         $_SESSION['errors'] = 'Ошибка при дублировании!';
      }
      redirect();
   }
}
