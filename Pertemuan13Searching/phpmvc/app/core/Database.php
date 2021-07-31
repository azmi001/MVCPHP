<?php

use function PHPSTORM_META\type;

class Database {
    // menyambungkan db config di config/config.php
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $dbh; //database handler
    private $stmt;  //(statement) buat nyimpen query

    public function __construct()
    {
        //data source name
        $dsn = 'mysql:host=' . $this->host .';dbname=' . $this->db_name;

        // Optimasi koneksi ke db biar nyambung terus
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $option);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // membuat function untuk menjalankan query menjadi generik, agar bisa dipakai secara fleksibel
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }


    //membuat binding data, dimana yang menentukan bukan admin tetapi systemnya
    public function bind($param, $value, $type = null) {
        if(is_null($type)) {
            switch(true) {
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }
        //mengamankan agar terhindar dari sql injection
        $this->stmt->bindValue($param, $value, $type);
    }

    // untuk eksekusi
    public function execute() {
        $this->stmt->execute();
    }

    // menentukan ingin banyak data
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // jika ingin satu data saja
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function rowCount() {
        return $this->stmt->rowCount();
    }
}