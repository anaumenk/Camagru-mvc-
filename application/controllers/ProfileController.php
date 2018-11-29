<?php


namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class ProfileController extends Controller {

    public function profileAction() {
        $pagination = new Pagination($this->route, $this->model->userImagesCount());
        $vars = [
            'images' => $this->model->userImagesList($this->route),
            'pagination' => $pagination->get(),
        ];
        $this->view->render('Profile', $vars);
    }

    public function editAction() {

        if (!empty($_POST['login']) and !empty($_POST['email'])) {

            if (!$this->model->textFieldsValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            else {
                $this->view->message('success', "login and email fields OK");
            }
        }

        if (!empty($_POST['old_pass']) and !empty($_POST['new_pass']) and !empty($_POST['rep_pass'])) {
            if (!$this->model->passFieldsValidate($_POST)) {
                $this->view->message('error', $this->model->error);
            }
            else {
                $this->view->message('success', "password field OK");
            }
        }

        if (!empty($_FILES['new_user_image'])) {
            $name = "$_SESSION[user]".time().".png";
            move_uploaded_file($_FILES['new_user_image']['tmp_name'], "public/images/profile/$name");
            $this->model->saveImage($name);
            $this->view->message('img', $name);
        }

        $vars = [
            'user' => $this->model->userInfo()[0],
        ];
        $this->view->render('Edit Profile', $vars);
    }

    public function add_pictureAction() {
        if ($_POST['img']) {
            $name = $this->model->createImg($_POST['img'], $_POST['patterns']);
            $this->view->message('success', $_POST['img']);
        }
//        else if ($_POST['save']) {
//            $name = $this->model->addPicture($_POST['save']);
//            $this->view->message('success', $name);
//        }

        $vars = [
            'photos' => $this->model->prevPhotos(),
        ];
        $this->view->render('Add picture', $vars);
    }
}