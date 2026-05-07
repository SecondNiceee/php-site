<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;
use shop\App;

class Category extends AppModel
{
   public function category_validate(): bool
   {
      $errors = '';
      $item = trim($_POST['title']);

      if (empty($item)) {
         $errors .= "Поле 'Наименование' обязательное<br>";
      }
      
      if ($errors) {
         $_SESSION['errors'] = $errors;
         $_SESSION['form_data'] = $_POST;
         return false;
      }
      return true;
   }
   public function save_category(): bool
    {
        R::begin();
        try {
            $category = R::dispense('category');
            $category->parent_id = post('parent_id', 'i');
            $category->title = post('title');
            $category_id = R::store($category);
            $category->slug = AppModel::create_slug('category', 'slug', $_POST['title'], $category_id);
            $category->description = post('description');
            $category->keywords = post('keywords');
            $category->price = post('price');
            $category->img = post('img');
            $category->icon = post('icon');
            $category->popular = post('popular') ? 1 : 0;
            $category->status = post('status') ? 1 : 0;
            
            R::store($category);

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            debug($e, 1);
            return false;
        }
    }

    public function update_category($id): bool
    {
        R::begin();
        try {
            $category = R::load('category', $id);
            if (!$category) {
                return false;
            }
            $category->parent_id = post('parent_id', 'i');
            $category->title = post('title');
            $category->description = post('description');
            $category->keywords = post('keywords');
            $category->price = post('price');
            $category->popular = post('popular');
            $category->img = post('img');
            $category->icon = post('icon');
            $category->popular = post('popular') ? 1 : 0;
            $category->status = post('status') ? 1 : 0;
            R::store($category);

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }
    public function get_category($id): array
    {
        return R::getRow("SELECT * FROM category WHERE id = ?", [$id]);
    }
}