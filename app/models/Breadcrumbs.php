<?php


namespace app\models;


use shop\App;

class Breadcrumbs extends AppModel
{

    public static function getBreadcrumbs($category_id, $name = '', $prod_slug = ''): string
    {
        $categories = App::$app->getProperty("categories");
        $breadcrumbs_array = self::getParts($categories, $category_id);
        $breadcrumbs = "<a class='crumbs__link' href='" . PATH . "'>Главная страница</a>";
        $breadcrumbs .= "&nbsp;&nbsp;/&nbsp;&nbsp;<a class='crumbs__link' href='" . PATH . "/catalog'>Каталог</a>";
        if ($breadcrumbs_array) {
            $i = 0;
            foreach ($breadcrumbs_array as $slug => $title) {                   
                if ($i == 0) {
                    $breadcrumbs .= "&nbsp;&nbsp;/&nbsp;&nbsp;<a class='crumbs__link' href='subcatalog/{$slug}'>{$title}</a>";
                } else {
                    $breadcrumbs .= "&nbsp;&nbsp;/&nbsp;&nbsp;<a class='crumbs__link' href='category/{$slug}'>{$title}</a>";
                }
                $i++;    
            }
        }
        if ($name) {
            $breadcrumbs .= "&nbsp;&nbsp;/&nbsp;&nbsp;" . "<a class='crumbs__link' href='product/{$prod_slug}'>$name</a>";
        }
        return $breadcrumbs;
    }

    public static function getParts($cats, $id): array|false
    {
        if (!$id) {
            return false;
        }
        $breadcrumbs = [];
        foreach ($cats as $k => $v) {
            if (isset($cats[$id])) {
                $breadcrumbs[$cats[$id]['slug']] = $cats[$id]['title'];
                $id = $cats[$id]['parent_id'];
            } else {
                break;
            }
        }
        return array_reverse($breadcrumbs, true);
    }

}