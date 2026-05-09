<?php
namespace app\controllers\admin;

use app\models\admin\Category;
use app\models\admin\Faq;
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
        $faqModel = new Faq();

        // Сохранение FAQ
        if (!empty($_POST['faq_action'])) {
            if ($_POST['faq_action'] === 'add' && !empty($_POST['faq_question'])) {
                $faqModel->save([
                    'entity_type' => 'category',
                    'entity_id'   => $id,
                    'question'    => $_POST['faq_question'],
                    'answer'      => $_POST['faq_answer'] ?? '',
                    'sort_order'  => (int)($_POST['faq_sort_order'] ?? 0),
                    'status'      => 1,
                ]);
                $_SESSION['success'] = 'FAQ добавлен';
            } elseif ($_POST['faq_action'] === 'delete' && !empty($_POST['faq_id'])) {
                $faqModel->delete((int)$_POST['faq_id']);
                $_SESSION['success'] = 'FAQ удален';
            }
            redirect();
        }

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
        $faqs = $faqModel->getFaqByEntity('category', $id);
        App::$app->setProperty('parent_id', $category['parent_id']);
        $title = 'Редактирование категории';
        $this->setMeta($title);
        $this->set(compact('title', 'category', 'faqs'));
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
