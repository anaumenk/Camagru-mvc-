<?php

namespace application\models;

use application\core\Model;

class Main extends Model {

    public $error;

    public function galleryCount() {
        $result = $this->db->row("SELECT COUNT(*) as `count` FROM images");
        return $result[0]['count'];
    }

    public function galleryList($route) {
        $max = 6;
        $params = [
            'max' => $max,
            'start' => (($route['page'] ? $route['page'] : 1) - 1) * $max,
        ];
        return $this->db->row("SELECT * FROM images ORDER BY id_img DESC LIMIT :start, :max", $params);
    }

    public function isLogin($login) {
        $params = [
            'login' => $login,
        ];
        return $this->db->row( "SELECT * FROM users WHERE user_name = :login", $params);
    }

    public function isEmail($email) {
        $params = [
            'email' => $email,
        ];
        $result = $this->db->row("SELECT email FROM users WHERE email = :email", $params);
        if ($result) {
            return false;
        }
        return true;
    }

    public function registerValidate($post) {
        $login = htmlspecialchars($post['login']);
        $email = htmlspecialchars($post['email']);
        $password = hash('whirlpool', $post['password']);
        $rep_pass = hash('whirlpool', $post['rep_pass']);
        if (strlen($post['login']) > 15) {
            $this->error = 'The login is too long.';
            return false;
        }
        else if($this->isLogin($login)) {
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
        else if (strlen($post['password']) < 8) {
            $this->error = 'The password must contain at least 8 characters.';
            return false;
        }
        else if(!($password == $rep_pass)) {
            $this->error = 'The passwords do not feet.';
            return false;
        }
        $this->createNewUser($login, $email, $password);
        return true;
    }

    public function createNewUser($login, $email, $password) {
        $token = hash('whirlpool', $email.time());
        $params = [
            'login' => $login,
            'email' => $email,
            'password' => $password,
            'token' => $token,
        ];
        $this->db->query("INSERT INTO users (`user_name`, `email`, `password`, `token`)
                              VALUES (:login, :email, :password, :token)", $params);
        $message = "<p>Hello!</p>
                    <p>You need to confirm your email address to complete your Camagru account.</p>
                    <p>It's easy — just click <a href='http://localhost:8080/activate/$token'>HERE</a>.</p>";
        $this->sendMessage($email, "Create account on Camagru", $message);
    }

    public function sendMessage($email, $subject, $message) {
        $subject_preferences = array(
            "input-charset" => "utf-8",
            "output-charset" => "utf-8",
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );
        $header = "Content-type: text/html; charset='utf-8'. \r\n";
        $header .= "From: Camagru <camagru@unit.ua> \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-Transfer-Encoding: 8bit \r\n";
        $header .= "Date: ".date("r (T)")." \r\n";
        $header .= iconv_mime_encode("Subject", $subject, $subject_preferences);
        mail("$email", "$subject", "$message", $header);
    }

    public function activate($token) {
        $params = [
            'token' => $token,
        ];
        $result = $this->db->row("SELECT * FROM users WHERE token = :token", $params);
        if (!$result) {
            $this->error = 'The incorrect activation code.';
            return false;
        }
        else if ($result[0]['activate'] != 0) {
            $this->error = 'The registration was already confirmed.';
            return false;
        }
        $this->db->query("UPDATE users SET `activate` = 1 WHERE `token` = :token", $params);
        $_SESSION['user'] = $result[0]['user_id'];
        return true;
    }

    public function loginValidate($post) {
        $login = htmlspecialchars($post['log_login']);
        $password = htmlspecialchars($post['log_password']);
        $result = $this->isLogin($login);
        if (!$result) {
            $this->error = 'The incorrect login.';
            return false;
        }
        else if ($result[0]['activate'] == 0) {
            $this->error = 'Non activated account.';
            return false;
        }
        else if (hash("whirlpool", $password) != $result[0]['password']) {
            $this->error = 'The incorrect password.';
            return false;
        }
        $_SESSION['user'] = $result[0]['user_id'];
        return true;
    }

    public function recoverValidate($post) {
        $login = htmlspecialchars($post['r-login']);
        $email = htmlspecialchars($post['r-email']);
        $result = $this->isLogin($login);
        if (!$result) {
            $this->error = 'Wrong login.';
            return false;
        }
        else if ($result[0]['email'] !== $email) {
            $this->error = 'Wrong email.';
            return false;
        }
        else if ($result[0]['activate'] == 0) {
            $this->error = 'Non activated account.';
            return false;
        }
        $this->recover($login, $email);
        return true;
    }

    public function recover($login, $email) {
        $new_password = time();
        $message = "<p>Hello!</p><p>Your new password on Camagru is <b>$new_password</b>.</p>";
        $pass = hash('whirlpool', $new_password);
        $params = [
            'login' => $login,
            'email' => $email,
            'password' => $pass,
        ];
        $this->db->query( "UPDATE `users` SET `password` = :password WHERE `user_name` = :login AND `email` = :email", $params);
        $subject = "Camagru";
        $subject_preferences = array(
            "input-charset" => "utf-8",
            "output-charset" => "utf-8",
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );
        $header = "Content-type: text/html; charset='utf-8'. \r\n";
        $header .= "From: Camagru <camagru@unit.ua> \r\n";
        $header .= "MIME-Version: 1.0 \r\n";
        $header .= "Content-Transfer-Encoding: 8bit \r\n";
        $header .= "Date: ".date("r (T)")." \r\n";
        $header .= iconv_mime_encode("Subject", $subject, $subject_preferences);
        mail("$email", "$subject", "$message", $header);
    }

    public function userInfo($img_id) {
        $params = [
          'id' => $img_id,
        ];
        $result = $this->db->row("SELECT * FROM users 
                                        INNER JOIN images 
                                        ON users.user_id = images.user_id
                                        WHERE images.id_img = :id ", $params);
        return $result[0];
    }

    public function imgInfo($img_id) {
        $params = [
            'id' => $img_id,
        ];
        $result = $this->db->row("SELECT * FROM images
                                       WHERE id_img = :id ", $params);
        return $result[0];
    }

    public function comments($img_id) {
        $params = [
            'id' => $img_id,
        ];
        return $this->db->row("SELECT users.user_image, users.user_name, comments.comment, comments.user_id
                                    FROM comments
                                    INNER JOIN users
                                    ON users.user_id = comments.user_id
                                    WHERE img_id = :id ", $params);
    }

    public function likes() {
        $params = [
            'id' => $_SESSION['user'],
        ];
        return $this->db->row("SELECT * FROM likes 
                                    WHERE user_id = :id ", $params);
    }
}