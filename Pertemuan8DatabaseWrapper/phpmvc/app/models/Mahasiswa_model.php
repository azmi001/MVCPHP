<?php
class Mahasiswa_model {

    private $table = 'mahasiswa';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //select from harus 'SELECT * FROM ' bukan 'SELECT * FROM'
    public function getALLMahasiswa() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getMahasiswaById($id) {
        //untuk menghindari sql injection
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        // baru di bind 
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}