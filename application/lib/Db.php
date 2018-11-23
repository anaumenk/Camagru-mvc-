<?php

namespace application\lib;
use PDOException;
use PDO;

class Db {
    protected $db;

    public function __construct() {
        $config = require 'application/config/db.php';

        try{
            $this->db = new PDO("mysql:host=$config[host];dbname=$config[dbname]", $config['user'], $config['password']);
        } catch (PDOException $e) {
            exec ("/Users/anaumenk/MAMP/mysql/bin/mysql -u root -pfktrcfylhf < /Users/anaumenk/MAMP/apache2/htdocs/php/application/config/camagru.sql");
            $this->db = new PDO("mysql:host=$config[host];dbname=$config[dbname]", $config['user'], $config['password']);
        }
    }

    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                if (is_int($val)) {
                    $type = PDO::PARAM_INT;
                } else {
                    $type = PDO::PARAM_STR;
                }
                $stmt->bindValue(':' .$key, $val, $type);
            }
        }
        $stmt->execute();
        return $stmt;
    }

    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

    public function lastInsertId() {
        return $this->db->lastInsertId();
    }
}