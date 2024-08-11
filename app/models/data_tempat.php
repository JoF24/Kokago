<?php

class Data_tempat {
    private $table = 'data_tempat';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getDataSemuaTempat(){
        $this->db->query("SELECT * FROM ".$this->table);
        $data = $this->db->resultset();
        return $data;
    }

    public function addTempat($lokasi, $kapasitas) {
        $this->db->query("INSERT INTO " . $this->table . " (lokasi, kapasitas) VALUES ('$lokasi', '$kapasitas')");
        return $this->db->execute();
    }

    public function getMaxId() {
        $this->db->query('SELECT MAX(id_data_tempat) as max_id FROM ' . $this->table);
        return $this->db->single()['max_id'];
    }

    public function getTempatById($id) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_data_tempat = '$id'");
        return $this->db->single();
    }

    public function updateTempat($id, $lokasi, $kapasitas){ 
        $this->db->query("UPDATE " . $this->table . " SET lokasi = '$lokasi', kapasitas = '$kapasitas' WHERE id_data_tempat = '$id'");
        return $this->db->execute();
    }

    public function deleteTempat($id) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_data_tempat = '$id'");
        return $this->db->execute();
    }
}