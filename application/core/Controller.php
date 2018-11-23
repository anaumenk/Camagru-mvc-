<?php

namespace application\core;
use application\core\View;

abstract class Controller {

    public $route;
    public $view;
    public $acl;

    public function __construct($route) {
        $this->route = $route;
        $this->view = new View($route);
        if(!$this->checkAcl()) {
            $this->view->redirect('/enter');
//            View::errorCode(403);
        }
        $this->model = $this->loadModel($route['controller']);
    }

    public function loadModel($name) {
        $path = 'application\models\\'. ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }

    public function checkAcl() {
        $this->acl = require 'application/acl/'.$this->route['controller'].'.php';
        if($this->isAcl('all')) {
            return true;
        }
        else if ($_SESSION['user'] and $this->isAcl('authorize')) {
            return true;
        }
        else if (!$_SESSION['user'] and $this->isAcl('guest')) {
            return true;
        }
        return false;
    }

    public function isAcl($key) {
         return in_array($this->route['action'], $this->acl[$key]);
    }
}