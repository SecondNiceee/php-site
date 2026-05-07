<?php


namespace app\models;


use RedBeanPHP\R;

class Page extends AppModel
{

    public function get_page($slug): array
    {
        return R::getRow("SELECT p.*, pd.* FROM page p JOIN page_description pd on p.id = pd.page_id WHERE p.slug = ? ", [$slug]);
    }

}