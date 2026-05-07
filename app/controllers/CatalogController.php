<?php

namespace app\controllers;

use app\models\Catalog;
use shop\App;
use app\models\Breadcrumbs;


class CatalogController extends AppController 
{
   public function viewAction()
   {
      $catalog = $this->model->get_catalog();
      $subcatalog = $this->model->get_subcatalog();
      $brands = $this->model->get_brand();

      if(!$catalog){
         if (!DEBUG) {
            $this->error_404();
            return;
         }
        throw new \Exception("Каталог пуст!", 404);
      }

      $breadcrumbs = Breadcrumbs::getBreadcrumbs('');

      $this->setMeta("Каталог продукции", '', '');
      $this->set(compact('catalog', 'subcatalog', 'breadcrumbs','brands'));

   }
}