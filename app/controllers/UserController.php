<?php


namespace app\controllers;

use app\models\User;

/** @property User $model */
class UserController extends AppController
{

    public function signupAction()
    {
        if (User::checkAuth()) {
            redirect(PATH);
        }

        if (!empty($_POST)) {
            $data = $_POST;
            $this->model->load($data);
            if (!$this->model->validate($data) || !$this->model->checkUnique()) {
                $this->model->getErrors();
                $_SESSION['form_data'] = $data;
            } else {
                $this->model->attributes['password'] = password_hash($this->model->attributes['password'], PASSWORD_DEFAULT);
                if($this->model->save('user')) {
                    $_SESSION['success'] = 'Учетная запись была создана';
                } else {
                    $_SESSION['errors'] = 'Ошибка регистрации!';
                }
                
            }
            redirect();
        }

        $this->setMeta('Регистрация');
    }

    public function loginAction()
    {
        if (User::checkAuth()) {
            redirect(PATH);
        }

        if (!empty($_POST)) {
            if ($this->model->login()) {
                $_SESSION['success'] = 'Успешная авторизация';
                redirect(PATH);
            } else {
                $_SESSION['errors'] = 'Ошибка авторизации';
                redirect();
            }
        }

        $this->setMeta('Авторизация');
    }

    public function logoutAction()
    {
        if (User::checkAuth()) {
            unset($_SESSION['user']);
        }
        redirect(PATH . '/user/login');
    }

}