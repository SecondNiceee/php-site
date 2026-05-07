<?php

namespace app\models;

use RedBeanPHP\R;

class Cart extends AppModel
{

    public array $attributes = [
        'fio' => '',
        'phone' => '',
        'email' => '',
    ];

    public array $rules = [
        'required' => ['fio', 'phone',],
        'email' => ['email',],
    ];
    
    public array $labels = [
        'fio' => 'ФИО',
        'phone' => 'Телефон',
        'email' => 'E-mail',
    ];

   public function get_product($id): array
   {
      return R::getRow("SELECT * FROM product WHERE status = 1 AND id = ?", [$id]);
   }
   public function get_product_info($id): array
   {
      return R::getAll("SELECT * FROM product_info WHERE product_id = ?", [$id]);
   }

   public function add_to_cart($product, $product_info, $qty = 1)
    {
        $qty = abs($qty);

        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product['id']] = [
                'title' => $product['title'],
                'content' => $product['content'],
                'product_info' => $product_info,
                'slug' => $product['slug'],
                'qty' => $qty,
                'img' => $product['img'],
            ];
        }

        $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        return true;
    }

    public function delete_item($id)
    {
        $qty_minus = $_SESSION['cart'][$id]['qty'];
        $_SESSION['cart.qty'] -= $qty_minus;
        unset($_SESSION['cart'][$id]);
    }
}