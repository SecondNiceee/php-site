<?php


namespace app\controllers\admin;


use app\models\admin\User;

class UserController extends AppController
{
    public function loginAdminAction() {
        if($this->model::isAdmin()) {
            redirect(ADMIN);
        }

        $this->layout = 'login';

        if (!empty($_POST)) {
            if ($this->model->login(true)) {
                $_SESSION['success'] = 'Вы успешно авторизованы';
            } else {
                $_SESSION['errors'] = 'Логин / пароль введены не верно, либо вы не являетесь Администратором';
            }
            if ($this->model::isAdmin()) {
                redirect(ADMIN);
            }else {
                redirect();
            }
        }
        
    }
    public function logoutAction()
    {
        if($this->model::isAdmin()) {
            unset($_SESSION['user']);
        }
        redirect(ADMIN . '/user/login-admin');
    }
}