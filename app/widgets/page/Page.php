<?php


namespace app\widgets\page;


use RedBeanPHP\R;
use shop\App;
use shop\Cache;

class Page
{

    protected string $container = 'ul';
    protected string $class = 'page-menu';
    protected int $cache = 3600;
    protected string $cacheKey = 'shop_page_menu';
    protected string $menuPageHtml;
    protected string $prepend = '';
    protected string $menu = '';
    protected $data;

    public function __construct($options = [])
    {
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options)
    {
        foreach ($options as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }

    protected function run()
    {
        $cache = Cache::getInstance();
        $this->menuPageHtml = $cache->get("{$this->cacheKey}");

        if (!$this->menuPageHtml) {
            $this->data = R::getAssoc("SELECT p.*, pd.* FROM page p 
                        JOIN page_description pd
                        ON p.id = pd.page_id
                        WHERE p.menu = ?
                        ", [$this->menu]);
                        
            $this->menuPageHtml = $this->getMenuPageHtml();
            if ($this->cache) {
                $cache->set("{$this->cacheKey}", $this->menuPageHtml, $this->cache);
            }
        }

        $this->output();
    }

    protected function getMenuPageHtml()
    {
        $html = '';
        foreach ($this->data as $k => $v) {
            $html .= "<li class='menu__item'><a class='menu__link' href='page/{$v['slug']}'>{$v['title']}</a></li>";
        }
        return $html;
    }

    protected function output()
    {
        echo "<{$this->container} class='{$this->class}'>";
        echo $this->prepend;
        echo $this->menuPageHtml;
        echo "</{$this->container}>";
    }

}