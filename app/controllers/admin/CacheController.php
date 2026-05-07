<?php

namespace app\controllers\admin;

use shop\App;
use shop\Cache;

class CacheController extends AppController
{
    public function indexAction() {
        $title = 'Управление кэшем';
        $this->setMeta($title);
        $this->set(compact('title')); 
    }

    public function deleteAction() {
        $cache_key = get('cache', 's');
        $cache = Cache::getInstance();
        if ($cache_key == 'category') {
            $cache->delete('shop_menu');
        }
        $_SESSION['success'] = 'Кэш удален';
        redirect();
    }
}