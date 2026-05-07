<?php

namespace app\controllers\admin;

use shop\App;
use RedBeanPHP\R;

class MainController extends AppController
{
    public function indexAction() {
        $orders = R::count('orders');
        $new_orders = R::count('orders', 'status = 0');
        $products = R::count('product');
       
        $this->setMeta('Панель управления ' . App::$app->getProperty('site_name'));
        $this->set(compact('orders', 'new_orders', 'products'));
        
    }
}