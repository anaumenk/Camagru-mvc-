<?php

namespace application\models;

use application\core\Model;
use application\models\Main;

class Profile extends Model{

    public $error;

    public function userImagesCount() {
        $params = [
            'id' => $_SESSION['user'],
        ];
        $result = $this->db->row("SELECT COUNT(*) as `count` FROM images WHERE user_id = :id", $params);
        return $result[0]['count'];
    }

    public function userImagesList($route) {
        $max = 6;
        $params = [
            'max' => $max,
            'start' => (($route['page'] ? $route['page'] : 1) - 1) * $max,
            'id' => $_SESSION['user'],
        ];
        return $this->db->row("SELECT * FROM images WHERE user_id = :id ORDER BY id_img DESC LIMIT :start, :max", $params);
    }

    public function userInfo() {
        $params = [
            'id' => $_SESSION['user'],
        ];
        return $this->db->row("SELECT * FROM users WHERE user_id = :id", $params);
    }

    public function textFieldsValidate($post) {
        $login = htmlspecialchars($post['login']);
        $email = htmlspecialchars($post['email']);
        if (strlen($post['login']) > 15) {
            $this->error = 'The login is too long.';
            return false;
        }
        else if ($this->isLogin($login)) {
            $this->error = 'The login is already exist.';
            return false;
        }
        else if(!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $this->error = 'Wrong email format.';
            return false;
        }
        else if (!$this->isEmail($email)) {
            $this->error = 'The email is already exist.';
            return false;
        }
        $this->sendMessageText($email, $login);
        $this->saveTextFields($login, $email, $post['checkbox']);
        return true;
    }

    public function isLogin($login) {
        $params = [
            'login' => $login,
            'id' => $_SESSION['user'],
        ];
        return $this->db->row( "SELECT * FROM users WHERE user_name = :login AND user_id != :id", $params);
    }

    public function isEmail($email) {
        $params = [
            'email' => $email,
            'id' => $_SESSION['user'],
        ];
        $result = $this->db->row("SELECT email FROM users WHERE email = :email AND user_id != :id", $params);
        if ($result) {
            return false;
        }
        return true;
    }

    public function saveTextFields($login, $email, $checkbox) {
        $params = [
            'login' => $login,
            'email' => $email,
            'id' => $_SESSION['user'],
            'checkbox' => $checkbox == 'on' ? 1 : 0,
        ];
        $this->db->query("UPDATE users SET `user_name` = :login, email = :email, comments = :checkbox  WHERE user_id = :id", $params);
    }

    public function sendMessageText($email, $login) {
        $mainModel = new Main;
        $result = $this->userInfo()[0];
        if ($result['email'] != $email) {
            $message = "<p>Hello, $login!</p><p>You have changed your email address.</p><p>The new one is <b>".$email."</b></p>";
            $mainModel->sendMessage($result['email'], "Change email on Camagru", $message);
            $message = "<p>Hello!</p><p>You have changed your email address.</p>";
            $mainModel->sendMessage($email, "Change email on Camagru", $message);
        }
        if ($result['user_name'] != $login) {
            $message = "<p>Hello!</p><p>Your old login was <b>".$result['user_name']."</b>.</p><p>Your new login is <b>".$login."</b>.</p>";
            $mainModel->sendMessage($email, "Change login on Camagru", $message);
        }
    }

    public function passFieldsValidate($post) {
        $mainModel = new Main;
        $old_pass = hash('whirlpool', $post['old_pass']);
        $new_pass = hash('whirlpool', $post['new_pass']);
        $rep_pass = hash('whirlpool', $post['rep_pass']);
        if (!$this->oldPassCheck($old_pass)) {
            $this->error = 'The incorrect old password.';
            return false;
        }
        else if ($new_pass != $rep_pass) {
            $this->error = 'The new and repeated new passwords do not match.';
            return false;
        }
        else if ($old_pass == $new_pass) {
            $this->error = 'The same old and new passwords.';
            return false;
        }
        else if (strlen($new_pass) < 8) {
            $this->error = 'The password must contain at least 8 characters.';
            return false;
        }
        $user = $this->userInfo()[0];
        $message = "<p>Hello!</p><p>You have changed your password.</p>";
        $mainModel->sendMessage($user['email'], "Change password on Camagru", $message);
        $this->savePassFields($new_pass);
        return true;
    }

    public function oldPassCheck($old_pass) {
        $params = [
            'id' => $_SESSION['user'],
            'password' => $old_pass,
        ];
        $result = $this->db->row("SELECT * FROM users WHERE password = :password AND user_id = :id", $params);
        if (!$result) {
            return false;
        }
        return true;
    }

    public function savePassFields($new_pass) {
        $params = [
            'id' => $_SESSION['user'],
            'pass' => $new_pass,
        ];
        $this->db->query("UPDATE users SET `password` = :pass  WHERE user_id = :id", $params);
    }

    public function saveImage($name) {
        $params = [
            'id' => $_SESSION['user'],
            'img' => $name,
        ];
        $this->db->query("UPDATE users SET user_image = :img WHERE user_id = :id", $params);
    }


}

