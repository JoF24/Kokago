<?php

class Data_staff_pelayan {
    private $table = 'data_staff_pelayan';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($nama, $password) 
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE nama_staff_pelayan ='".$nama."'");
        $user = $this->db->single();
        if ($user && ($password == $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getDataSemuaStaff(){
        $this->db->query("SELECT * FROM ".$this->table);
        $data = $this->db->resultset();
        return $data;
    }

    public function addStaff($nama_staff, $no_telepon, $alamat) {
        $this->db->query("INSERT INTO " . $this->table . " (nama_staff_pelayan, no_telepon_staff_pelayan, alamat_staff_pelayan) VALUES ('$nama_staff', '$no_telepon', '$alamat')");
        return $this->db->execute();
    }

    public function getMaxId() {
        $this->db->query('SELECT MAX(id_data_staff_pelayan) as max_id FROM ' . $this->table);
        return $this->db->single()['max_id'];
    }

    public function getStaffById($id) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_data_staff_pelayan = '$id'");
        return $this->db->single();
    }

    public function updateStaff($id, $nama_staff, $no_telepon, $alamat){ 
        $this->db->query("UPDATE " . $this->table . " SET nama_staff_pelayan = '$nama_staff', no_telepon_staff_pelayan = '$no_telepon', alamat_staff_pelayan = '$alamat' WHERE id_data_staff_pelayan = '$id'");
        return $this->db->execute();
    }

    public function deleteStaff($id) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_data_staff_pelayan = '$id'");
        return $this->db->execute();
    }

}