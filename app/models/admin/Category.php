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
            $category->seo_title = post('seo_title');
            $category->description = post('description');
            $category->content = post('content');
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
            
            // Обновление slug
            $newSlug = post('slug');
            if (!empty($newSlug)) {
                $newSlug = AppModel::str2url($newSlug);
                // Проверяем уникальность slug, исключая текущую запись
                $existingSlug = R::findOne('category', 'slug = ? AND id != ?', [$newSlug, $id]);
                if ($existingSlug) {
                    $newSlug = $newSlug . '-' . $id;
                }
                $category->slug = $newSlug;
            }
            
            $category->seo_title = post('seo_title');
            $category->description = post('description');
            $category->content = post('content');
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

    public function duplicate_category($id): int|false
    {
        R::begin();
        try {
            $original = R::getRow("SELECT * FROM category WHERE id = ?", [$id]);
            if (!$original) {
                return false;
            }
            
            $category = R::dispense('category');
            $category->parent_id = $original['parent_id'];
            $category->title = $original['title'] . ' (копия)';
            $category_id = R::store($category);
            
            $category->slug = AppModel::create_slug('category', 'slug', $category->title, $category_id);
            $category->seo_title = $original['seo_title'] ?? '';
            $category->description = $original['description'];
            $category->content = $original['content'];
            $category->keywords = $original['keywords'];
            $category->price = $original['price'];
            $category->img = $original['img'];
            $category->icon = $original['icon'];
            $category->popular = $original['popular'];
            $category->status = $original['status']; // Копируем статус оригинала
            
            R::store($category);
            R::commit();
            return $category_id;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }
}
