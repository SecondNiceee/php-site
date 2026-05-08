<?php
namespace app\controllers;

class CongratulationController extends AppController
{
    public function indexAction()
    {
        $this->setMeta('Спасибо за участие', 'Тест успешно завершен', 'congratulation');
    }
}
