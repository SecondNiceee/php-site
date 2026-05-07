<?php


namespace app\models\admin;


use app\models\AppModel;
use RedBeanPHP\R;

class Brand extends AppModel
{

    public function get_brands(): array
    {
        return R::getAll("SELECT id, img, title, status FROM brand ORDER BY id DESC");
    }

    public function brand_validate(): bool
    {
        $errors = '';
        if(!post('title')) {
            $errors .= 'Не заполнено наименование бренда.<br>';
        }
        if(!post('img')) {
            $errors .= 'Вы не выбрали логотип.<br>';
        }
        if(!post('slug')) {
            $errors .= 'Не заполнен транслит (slug).<br>';
        } else {
            // Проверка уникальности slug
            $existing = R::getRow("SELECT id FROM brand WHERE slug = ? AND id != ?", [post('slug'), post('id') ?? 0]);
            if($existing) {
                $errors .= 'Такой транслит (slug) уже используется.<br>';
            }
        }
        
        if($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        } 
        return true;
    }

    public function save_brand(): bool
    {
        R::begin();
        try {
            $brand = R::dispense('brand');
            $brand->status = post('status') ? 1 : 0;
            $brand->popular = post('popular') ? 1 : 0;
            $brand->img = post('img') ?: NO_IMAGE;
            $brand->title = post('title');
            $brand->slug = post('slug');
            $brand->content = post('content');
            R::store($brand);
            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            //debug($e, 1);
            $_SESSION['form_data'] = $_POST;
            return false;
        }
    }

    public function get_brand($id): array|false
    {
        $brand = R::getRow("SELECT * FROM brand WHERE id = ?", [$id]);
        if (!$brand) {
            return false;
        }   
       
        return $brand;
    }

    public function update_brand($id): bool
    {
        R::begin();
        try {
            $brand = R::load('brand', $id);
            if(!$brand) {
                return false;
            }
            $brand->status = post('status') ? 1 : 0;
            $brand->popular = post('popular') ? 1 : 0;
            $brand->img = post('img') ?: NO_IMAGE;
            $brand->title = post('title');
            $brand->slug = post('slug');
            $brand->content = post('content');
            R::store($brand);
            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            //debug($e, 1);
            return false;
        }
    }

    public function get_brand_by_slug($slug): array|false
    {
        $brand = R::getRow("SELECT * FROM brand WHERE status = 1 AND slug = ?", [$slug]);
        if (!$brand) {
            return false;
        }   
       
        return $brand;
    }

    public function get_products_by_brand($brand_id, $start, $perpage): array
    {
        return R::getAll("SELECT * FROM product WHERE status = 1 AND brand_id = ? LIMIT $start, $perpage", [$brand_id]);
    }

    public function get_count_products_by_brand($brand_id): int
    {
        return R::count('product', "brand_id = ? AND status = 1", [$brand_id]);
    }
}