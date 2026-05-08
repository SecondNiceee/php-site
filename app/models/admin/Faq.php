<?php

namespace app\models\admin;

use RedBeanPHP\R;

class Faq
{
    /**
     * Получить все вопросы для конкретной сущности
     */
    public function getFaqByEntity($type, $id)
    {
        return R::getAll("
            SELECT * FROM faq 
            WHERE entity_type = ? AND entity_id = ? AND status = 1 
            ORDER BY sort_order ASC, id ASC
        ", [$type, $id]);
    }

    /**
     * Получить вопрос по ID
     */
    public function getById($id)
    {
        return R::findOne('faq', 'id = ?', [$id]);
    }

    /**
     * Сохранить вопрос (создать или обновить)
     */
    public function save($data)
    {
        if (!empty($data['id'])) {
            $faq = R::load('faq', $data['id']);
        } else {
            $faq = R::dispense('faq');
        }

        $faq->entity_type = $data['entity_type'];
        $faq->entity_id = (int)$data['entity_id'];
        $faq->question = $data['question'];
        $faq->answer = $data['answer'];
        $faq->sort_order = (int)$data['sort_order'];
        $faq->status = (int)$data['status'];
        
        return R::store($faq);
    }

    /**
     * Удалить вопрос
     */
    public function delete($id)
    {
        $faq = R::load('faq', $id);
        R::trash($faq);
    }

    /**
     * Получить список вопросов для админки (с фильтрацией)
     */
    public function getAdminList($type = null, $entityId = null)
    {
        $where = [];
        $params = [];

        if ($type !== null && $type !== '') {
            $where[] = "entity_type = ?";
            $params[] = $type;
        }

        if ($entityId !== null && $entityId !== '') {
            $where[] = "entity_id = ?";
            $params[] = (int)$entityId;
        }

        $sql = "SELECT * FROM faq";
        if (!empty($where)) {
            $sql .= " WHERE " . implode(' AND ', $where);
        }
        $sql .= " ORDER BY entity_type, entity_id, sort_order ASC, id ASC";

        return R::getAll($sql, $params);
    }

    /**
     * Получить названия сущностей для отображения в списке
     */
    public function getEntityTitle($type, $id)
    {
        if ($id == 0 && $type == 'main') {
            return 'Главная страница';
        }

        switch ($type) {
            case 'product':
                $item = R::findOne('product', 'id = ?', [$id]);
                return $item ? $item['title'] : 'Товар не найден';
            case 'category':
                $item = R::findOne('category', 'id = ?', [$id]);
                return $item ? $item['title'] : 'Категория не найдена';
            case 'brand':
                $item = R::findOne('brand', 'id = ?', [$id]);
                return $item ? $item['title'] : 'Бренд не найден';
            default:
                return 'Неизвестная сущность';
        }
    }

    /**
     * Получить название сущности по slug
     */
    public function getEntityTitleBySlug($type, $slug)
    {
        if ($slug == 'main' && $type == 'main') {
            return 'Главная страница';
        }

        switch ($type) {
            case 'product':
                $item = R::findOne('product', 'slug = ?', [$slug]);
                return $item ? $item['title'] : 'Товар не найден';
            case 'category':
                $item = R::findOne('category', 'slug = ?', [$slug]);
                return $item ? $item['title'] : 'Категория не найдена';
            case 'brand':
                $item = R::findOne('brand', 'slug = ?', [$slug]);
                return $item ? $item['title'] : 'Бренд не найден';
            default:
                return 'Неизвестная сущность';
        }
    }

    /**
     * Получить ID сущности по slug
     */
    public function getEntityIdBySlug($type, $slug)
    {
        if ($slug == 'main' && $type == 'main') {
            return 0;
        }

        switch ($type) {
            case 'product':
                $item = R::findOne('product', 'slug = ?', [$slug]);
                return $item ? (int)$item['id'] : 0;
            case 'category':
                $item = R::findOne('category', 'slug = ?', [$slug]);
                return $item ? (int)$item['id'] : 0;
            case 'brand':
                $item = R::findOne('brand', 'slug = ?', [$slug]);
                return $item ? (int)$item['id'] : 0;
            default:
                return 0;
        }
    }
}
