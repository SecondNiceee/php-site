<?php

namespace app\controllers\admin;

use app\models\Order;

class OrderController extends AppController
{
    public function indexAction()
   {
      $status = get('status', 's');
      $status = ($status == 'new') ? ' status = 0' : '';

      $orders = $this->model->get_orders($status);
      $title = 'Список заказов';
        $this->setMeta("$title");
        $this->set(compact('title', 'orders'));
   }

   public function editAction()
    {
        $id = get('id');

        if (isset($_GET['status'])) {
            $status = get('status');
            if ($this->model->change_status($id, $status)) {
                $_SESSION['success'] = 'Статус заказа изменен';
            } else {
                $_SESSION['errors'] = 'Ошибка изменения статуса заказа';
            }
        }

        $order = $this->model->get_order($id);
        
        if (!$order) {
            throw new \Exception('Not found order', 404);
        }
        $title = "Заказ № {$id}";
        $this->setMeta("$title");
        $this->set(compact('title', 'order'));
    }
}