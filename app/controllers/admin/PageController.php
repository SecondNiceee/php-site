<?php


namespace app\controllers\admin;


use app\models\admin\Page;
use RedBeanPHP\R;
use shop\App;
use shop\Cache;

/** @property Page $model */
class PageController extends AppController
{

    public function indexAction()
    {
        $page = get('page');

        $pages = $this->model->get_pages();
        $title = 'Список страниц';
        $this->setMeta("$title");
        $this->set(compact('title', 'pages'));
    }

    public function deleteAction()
    {
        $id = get('id');
        if ($this->model->deletePage($id)) {
            $_SESSION['success'] = 'Страница удалена';
            $cache = Cache::getInstance();
            $cache->delete('shop_page_menu');
        } else {
            $_SESSION['errors'] = 'Ошибка удаления страницы';
        }
        redirect();
    }

    public function addAction()
    {
        
        if (!empty($_POST)) {
            if ($this->model->page_validate()) {
                if ($this->model->save_page()) {
                    $_SESSION['success'] = 'Страница добавлена';
                    $cache = Cache::getInstance();
                    $cache->delete('shop_page_menu');
                } else {
                    $_SESSION['errors'] = 'Ошибка добавления страницы';
                }
            }
            redirect();
        }

        $title = 'Новая страница';
        $this->setMeta($title);
        $this->set(compact('title'));
    }

    public function editAction()
    {
        $id = get('id');

        if (!empty($_POST)) {
            if ($this->model->page_validate()) {
                if ($this->model->update_page($id)) {
                    $_SESSION['success'] = 'Страница сохранена';
                    $cache = Cache::getInstance();
                    $cache->delete('shop_page_menu');
                } else {
                    $_SESSION['errors'] = 'Ошибка обновления страницы';
                }
            }
            redirect();
        }

        $page = $this->model->get_page($id);
        if (!$page) {
            throw new \Exception('Not found page', 404);
        }
        $title = 'Редактирование страницы';
        $this->setMeta("Админка :: {$title}");
        $this->set(compact('title', 'page'));
    }

}