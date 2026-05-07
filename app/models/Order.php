<?php


namespace app\models;


use RedBeanPHP\R;
use PHPMailer\PHPMailer\PHPMailer;

class Order extends AppModel
{
    public static function saveOrder($data): int|false
    {
        R::begin();
        try {
            $order = R::dispense('orders');
            $order->note = $data['note'];
            $order->fio = $data['fio'];
            $order->company = $data['company'];
            $order->phone = $data['phone'];
            $order->email = $data['email'];
            $order->qty = $_SESSION['cart.qty'];
            $order_id = R::store($order);
            self::saveOrderProduct($order_id);

            R::commit();
            return $order_id;
        } catch (\Exception $e) {
            R::rollback();
            return false;
        }
    }

    public static function saveOrderProduct($order_id)
    {
        $sql_part = '';
        $binds = [];
        foreach ($_SESSION['cart'] as $product_id => $product) {
            $sql_part .= "(?,?,?,?,?),";
            $binds = array_merge($binds, [$order_id, $product_id, $product['title'], $product['slug'], $product['qty']]);
        }
        $sql_part = rtrim($sql_part, ',');
        R::exec("INSERT INTO order_product (order_id, product_id, title, slug, qty) VALUES $sql_part", $binds);
    }

    public static function mailOrder($order_id, $user_email, $tpl, $data): bool
    {
        $mail = new PHPMailer(true);

        try {
            $mail->CharSet = "UTF-8";
            $mail->setFrom('admin@potokmsk.ru', 'potokmsk.ru');
            $mail->addAddress($user_email);

            $mail->isHTML(true);
            $mail->Subject = "Новый заказ №{$order_id}";
            ob_start();
            require \APP . "/views/mail/{$tpl}.php";
            $body = ob_get_clean();
            $mail->Body = $body;
            return $mail->send();
        } catch (\Exception $e) {
            return false;
        }
    }

}