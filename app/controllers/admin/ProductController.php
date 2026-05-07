<?php


namespace app\controllers\admin;


use app\models\admin\Product;
use RedBeanPHP\R;
use shop\App;
use shop\Pagination;

/** @property Product $model */
class ProductController extends AppController
{

    public function indexAction()
    {
        $products = $this->model->get_products();
        $title = 'Список товаров';
        $this->setMeta($title);
        $this->set(compact('title', 'products'));
    }

    public function addAction()
    {
        if (!empty($_POST)) {
            if($this->model->product_validate()) {
                if($this->model->save_product()) {
                    $_SESSION['success'] = 'Товар добавлен';
                } else {
                    $_SESSION['errors'] = 'Товар не добавлен';
                }   
            }
            
            redirect();
        }

        $brands = $this->model->get_brands();

        $title = 'Новый товар';
        $this->setMeta("$title");
        $this->set(compact('title', 'brands'));
    }

    public function editAction()
    {
        $id = get('id');

        if (!empty($_POST)) {
            if ($this->model->product_validate()) {
                if ($this->model->update_product($id)) {
                    $_SESSION['success'] = 'Товар обновлен';
                } else {
                    $_SESSION['errors'] = 'Ошибка обновления товара';
                }
            }
            redirect();
        } 

        $brands = $this->model->get_brands();
        $product = $this->model->get_product($id);
        if (!$product) {
            throw new \Exception('Нет такого продукта', 404);
        }

        App::$app->setProperty('parent_id', $product['category_id']);
        $title = 'Редактирование товара';
        $this->setMeta("$title");
        $this->set(compact('title', 'product', 'brands'));
    }

    public function deleteAction()
   {
        $id = get('id');
        if( R::exec("DELETE FROM product WHERE id = ?", [$id])) {
            R::exec("DELETE FROM product_info WHERE product_id = ?", [$id]);
            $_SESSION['success'] = 'Товар удален';
        }  
        redirect();
   }
   public function copyAction()
    {
        $id = get('id');
        
        if ($this->model->copy_product($id)) {
            $_SESSION['success'] = 'Товар скопирован';
        } else {
            $_SESSION['errors'] = 'Ошибка копирования товара';
        }
        
        redirect();
    }

    

}