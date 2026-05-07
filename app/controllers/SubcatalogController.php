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
      $subcatalog = $this->model->get_subcatalog($catalog[0]['id']);
      $brands = $this->model->get_brand();

      if(!$subcatalog){
         $this->error_404();
         return;
      }

      $breadcrumbs = Breadcrumbs::getBreadcrumbs($catalog[0]['id']);

      $this->setMeta($catalog[0]['title'], '', '');
      $this->set(compact('catalog', 'subcatalog', 'breadcrumbs', 'brands'));

   }
}