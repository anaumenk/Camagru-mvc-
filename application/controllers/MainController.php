<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class MainController extends Controller {

    public function indexAction() {
        $pagination = new Pagination($this->route, $this->model->galleryCount());
        $vars = [
            'images' => $this->model->galleryList($this->route),
            'pagination' => $pagination->get(),
        ];
        $this->view->render('Camagru', $vars);
    }

    public function enterAction() {
        $this->view->render('Entering');
    }

    public function loginAction() {

        if (!empty($_POST['log_login']) and !empty($_POST['log_password'])) {
            if (!$this->model->loginValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            else {
                $this->view->location('/profile');
            }
        }
        $this->view->render('Login');
    }

    public function recoverAction() {
        if (!empty($_POST['r-login']) and !empty($_POST['r-email'])) {
            if (!$this->model->recoverValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            else {
                $this->view->location('/enter/login');
            }
        }
        $this->view->render('Recover');
    }

    public function registerAction() {
        if (!empty($_POST['login']) and !empty($_POST['email'])
            and !empty($_POST['password']) and !empty($_POST['rep_pass'])) {
            if (!$this->model->registerValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            else {
                $this->view->location('/');
            }
        }
        $this->view->render('Register');
    }

    public function activateAction() {
        if($this->model->activate($this->route['token'])) {
            $this->view->redirect('/profile');
        }
        $vars = [
            'error' => $this->model->error,
        ];
        $this->view->render('Activate', $vars);
    }

    public function logoutAction() {
        unset($_SESSION['user']);
        $this->view->redirect('/');
    }

    public function openAction() {
        $img_id = $this->route['id'];
        $vars = [
            'user' => $this->model->userInfo($img_id),
            'img' => $this->model->imgInfo($img_id),
            'comments' => $this->model->comments($img_id),
            'likes' => $this->model->likes(),
        ];
        $this->view->render('Image', $vars);
    }
}