<?php


namespace app\models\admin;


use app\models\AppModel;
use RedBeanPHP\R;

class Product extends AppModel
{

    public function get_products(): array
    {
        return R::getAll("SELECT id, img, title, status FROM product ORDER BY id DESC");
    }

    public function product_validate(): bool
    {
        $errors = '';
        if(!post('title')) {
            $errors .= 'Не заполнено наименование товара.<br>';
        }
        if(post('parent_id') == 0) {
            $errors .= 'Вы не выбрали категорию.<br>';
        }
        if(post('brand_id') == 0) {
            $errors .= 'Вы не выбрали бренд.<br>';
        }
        if($errors) {
            $_SESSION['errors'] = $errors;
            $_SESSION['form_data'] = $_POST;
            return false;
        } 
        return true;
    }

    public function save_product(): bool
    {
        R::begin();
        try {
            // product
            $product = R::dispense('product');
            $product->category_id = post('parent_id', 'i');
            $product->brand_id = post('brand_id', 'i');
            $product->status = post('status') ? 1 : 0;
            $product->img = post('img') ?: NO_IMAGE;
            $product->title = post('title');
            $product->content = post('content');
            $product->keywords = post('keywords');
            $product->description = post('description');
            $product->tech_desc = post('teh');
            $product->brochure = post('broshura');
            $product_id = R::store($product);
            
            $product->slug = AppModel::create_slug('product', 'slug', $_POST['title'], $product_id);
            R::store($product);
            
            // product_info
            if(isset($_POST['product_info'])){
                foreach ($_POST['product_info'] as $val => $item) {
                    R::exec("INSERT INTO product_info (product_id, info_key, info_val) VALUES (?,?,?)", [
                        $product_id,
                        $item['key'],
                        $item['value'],
                    ]);
                } 
            }

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            //debug($e, 1);

            $_SESSION['form_data'] = $_POST;
            return false;
        }
    }

    public function get_product($id): array|false
    {
        $product = R::getRow("SELECT * FROM product WHERE id = ?", [$id]);
        $product['product_info'] = R::getAll("SELECT * FROM product_info WHERE product_id = ?", [$id]);
        if (!$product) {
            return false;
        }   
       
        return $product;
    }

    public function update_product($id): bool
    {
        R::begin();
        try {
            // product
            $product = R::load('product', $id);
            if(!$product) {
                return false;
            }
            $product->category_id = post('parent_id', 'i');
            $product->brand_id = post('brand_id', 'i');
            $product->status = post('status') ? 1 : 0;
            $product->img = post('img') ?: NO_IMAGE;
            $product->title = post('title');
            $product->content = post('content');
            $product->keywords = post('keywords');
            $product->description = post('description');
            $product->tech_desc = post('teh');
            $product->brochure = post('broshura');
            $product_id = R::store($product);
            $product->slug = AppModel::create_slug('product', 'slug', $_POST['title'], $product_id);
            R::store($product);
            
            // product_info
            if(isset($_POST['product_info'])){
                R::exec("DELETE FROM product_info WHERE product_id = ?", [$id]);
                foreach ($_POST['product_info'] as $val => $item) {
                    R::exec("INSERT INTO product_info (product_id, info_key, info_val) VALUES (?,?,?)", [
                        $id,
                        $item['key'],
                        $item['value'],
                    ]);
                }
            } else {
                R::exec("DELETE FROM product_info WHERE product_id = ?", [$id]);
            }

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            //debug($e, 1);
            return false;
        }
    }

    public function get_brands(Type $var = null)
    {
        return R::getAll("SELECT id, title FROM brand");
    }
    
    public function copy_product($id)
    {
        $product = $this->get_product($id);

        R::begin();
        try {
            // product
            $product_copy = R::dispense('product');
            $product_copy->category_id = $product['category_id'];
            $product_copy->brand_id = $product['brand_id'];
            $product_copy->status = $product['status'];
            $product_copy->img = $product['img'];
            $product_copy->title = $product['title'];
            $product_copy->content = $product['content'];
            $product_copy->keywords = $product['keywords'];
            $product_copy->description = $product['description'];
            $product_copy->tech_desc = $product['tech_desc'];
            $product_copy->brochure = $product['brochure'];
            $product_copy_id = R::store($product_copy);
            
            $product_copy->slug = AppModel::create_slug('product', 'slug', $product['title'], $product_copy_id);
            R::store($product_copy);
            // product_info
            if(isset($product['product_info'])){
                foreach ($product['product_info'] as $val => $item) {
                    R::exec("INSERT INTO product_info (product_id, info_key, info_val) VALUES (?,?,?)", [
                        $product_copy_id,
                        $item['info_key'],
                        $item['info_val'],
                    ]);
                } 
            }

            R::commit();
            return true;
        } catch (\Exception $e) {
            R::rollback();
            //debug($e, 1);
            return false;
        }
        
    }
}