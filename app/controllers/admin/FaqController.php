<?php

namespace app\controllers\admin;

use app\models\admin\Faq;
use RedBeanPHP\R;

class FaqController extends AppController
{
    public function __construct($route)
    {
        parent::__construct($route);
        $this->model = new Faq();
    }

    /**
     * Список всех вопросов
     */
    public function indexAction()
    {
        $type = $_GET['type'] ?? '';
        $entityId = $_GET['entity_id'] ?? '';
        
        $faqs = $this->model->getAdminList($type !== '' ? $type : null, $entityId !== '' ? $entityId : null);
        
        // Добавляем названия сущностей
        foreach ($faqs as &$faq) {
            $faq['entity_title'] = $this->model->getEntityTitle($faq['entity_type'], $faq['entity_id']);
        }
        unset($faq);

        $this->setMeta('Вопросы и ответы - Админ панель');
        $this->set(compact('faqs', 'type', 'entityId'));
    }

    /**
     * Добавить вопрос
     */
    public function addAction()
    {
        if (!empty($_POST)) {
            // Если передан slug вместо entity_id, конвертируем его в ID
            if (!empty($_POST['entity_slug']) && !empty($_POST['entity_type'])) {
                $_POST['entity_id'] = $this->model->getEntityIdBySlug($_POST['entity_type'], $_POST['entity_slug']);
                if ($_POST['entity_id'] == 0 && $_POST['entity_type'] !== 'main') {
                    $_SESSION['errors'] = 'Сущность с таким slug не найдена';
                    redirect(ADMIN . '/faq/add');
                }
            }
            
            $id = $this->model->save($_POST);
            $_SESSION['success'] = 'Вопрос добавлен';
            redirect(ADMIN . '/faq');
        }

        $this->setMeta('Добавить вопрос - Админ панель');
        
        // Получаем списки для селектов с slug'ами
        $categories = R::getAll("SELECT id, title, slug FROM category WHERE status = 1 ORDER BY title ASC");
        $brands = R::getAll("SELECT id, title, slug FROM brand WHERE status = 1 ORDER BY title ASC");
        $products = R::getAll("SELECT id, title, slug FROM product WHERE status = 1 ORDER BY title ASC LIMIT 100");
        
        $this->set(compact('categories', 'brands', 'products'));
    }

    /**
     * Редактировать вопрос
     */
    public function editAction()
    {
        $id = get('id');
        
        if (!empty($_POST)) {
            // Если передан slug вместо entity_id, конвертируем его в ID
            if (!empty($_POST['entity_slug']) && !empty($_POST['entity_type'])) {
                $_POST['entity_id'] = $this->model->getEntityIdBySlug($_POST['entity_type'], $_POST['entity_slug']);
                if ($_POST['entity_id'] == 0 && $_POST['entity_type'] !== 'main') {
                    $_SESSION['errors'] = 'Сущность с таким slug не найдена';
                    redirect(ADMIN . '/faq/edit/' . $id);
                }
            }
            
            $_POST['id'] = $id;
            $this->model->save($_POST);
            $_SESSION['success'] = 'Вопрос обновлен';
            redirect(ADMIN . '/faq');
        }

        $faq = $this->model->getById($id);
        if (!$faq) {
            $_SESSION['errors'] = 'Вопрос не найден';
            redirect(ADMIN . '/faq');
        }

        $this->setMeta('Редактировать вопрос - Админ панель');
        
        // Получаем списки для селектов с slug'ами
        $categories = R::getAll("SELECT id, title, slug FROM category WHERE status = 1 ORDER BY title ASC");
        $brands = R::getAll("SELECT id, title, slug FROM brand WHERE status = 1 ORDER BY title ASC");
        $products = R::getAll("SELECT id, title, slug FROM product WHERE status = 1 ORDER BY title ASC LIMIT 100");
        
        $this->set(compact('faq', 'categories', 'brands', 'products'));
    }

    /**
     * Удалить вопрос
     */
    public function deleteAction()
    {
        $id = get('id');
        $this->model->delete($id);
        $_SESSION['success'] = 'Вопрос удален';
        redirect(ADMIN . '/faq');
    }
}
