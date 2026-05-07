<?php

namespace app\models\admin;

use app\models\AppModel;
use RedBeanPHP\R;

class Order extends AppModel
{
   public function get_orders($status)
   {
      if ($status) {
         return R::getAll("SELECT * FROM orders WHERE $status ORDER BY id DESC");
      } else {
         return R::getAll("SELECT * FROM orders ORDER BY id DESC");
      }
   }

   public function get_order($id): array
   {
       return R::getAll("SELECT o.*, op.* FROM orders o JOIN order_product op on o.id = op.order_id WHERE o.id = ?", [$id]);
   }

   public function change_status($id, $status): bool
   {
       $status = ($status == 1) ? 1 : 0;
       R::begin();
       try {
           R::exec("UPDATE orders SET status = ? WHERE id = ?", [$status, $id]);
           R::commit();
           return true;
       } catch (\Exception $e) {
           R::rollback();
           return false;
       }
   }
}