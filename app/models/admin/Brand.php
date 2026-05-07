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
            R::store($brand);
            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            //debug($e, 1);
            return false;
        }
    }
}