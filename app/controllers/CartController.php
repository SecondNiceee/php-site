<?php 
namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use shop\App;

class CartController extends AppController
{

    public function viewAction ()
    {
        $this->setMeta('Корзина');
    }
   public function addAction()
   {
      $id = get('id');
      $qty = get('qty');

      if (!$id) {
         return false;
      }

      $product = $this->model->get_product($id);
      $product_info = $this->model->get_product_info($product['id']);
      

      if(!$product) {
         return false; 
      }

      $this->model->add_to_cart($product, $product_info, $qty);

      if($this->isAjax()) {
         $this->loadView('cart_modal');
      }
      redirect();
      return true;
   }

   public function showAction() {
      $this->loadView('cart_modal');
   }

   public function deleteAction()
    {
        $id = get('id');
        if (isset($_SESSION['cart'][$id])) {
            $this->model->delete_item($id);
        }
        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }
        redirect();
    }

    public function clearAction()
    {
        if (empty($_SESSION['cart'])) {
            return false;
        }
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        $this->loadView('cart_modal');
        return true;
    }
    
    public function checkoutAction()
    {
        if(!empty($_POST)) {
            $datas = $_POST;
            
            $this->model->load($datas);
            
            if (!$this->model->validate($datas)) {
                $this->model->getErrors();
            } else {
                $data['note'] = post('note');
                $data['email'] = post('email');
                $data['fio'] = post('fio');
                $data['company'] = post('company');
                $data['phone'] = post('phone');
    
                if (!$order_id = Order::saveOrder($data)) {
                    $_SESSION['errors'] = 'Ошибка оформления заказа!';
                } else {
                    Order::mailOrder($order_id, App::$app->getProperty('admin_email'), 'mail_order', $data);
                    unset($_SESSION['cart']);
                    unset($_SESSION['cart.qty']);
                    $_SESSION['success'] = 'Спасибо за Ваш заказ. В ближайшее всермя с Вами свяжется менеджер для согласования заказа.';
                }
            }
        }
        redirect();
    }
}