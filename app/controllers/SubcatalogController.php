<?php

namespace app\controllers;

use app\models\Subcatalog;
use shop\App;
use app\models\Breadcrumbs;


class SubcatalogController extends AppController 
{
   public function viewAction()
   {
      $catalog = $this->model->get_catalog($this->route['slug']);
      
      // Проверяем, что категория найдена
      if (empty($catalog)) {
         $this->error_404();
         return;
      }
      
      $category = $catalog[0];
      $subcatalog = $this->model->get_subcatalog($category['id']);
      $brands = $this->model->get_brand();

      $breadcrumbs = Breadcrumbs::getBreadcrumbs($category['id']);

      $this->setMeta($category['title'], '', '');
      $this->set(compact('catalog', 'category', 'subcatalog', 'breadcrumbs', 'brands'));

   }
}
