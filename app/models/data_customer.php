<?php

class Data_customer {
    private $table = 'data_customer';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($nama, $password) 
    {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE nama_customer ='".$nama."'");
        $user = $this->db->single();
        if ($user && ($password == $user['password'])) {
            return $user;
        }
        return false;
    }

    public function insert_akun($nama, $no_telepon, $password, $alamat){
        $sql = "INSERT INTO ".$this->table." (nama_customer, no_telepon_customer, password, alamat_customer) VALUES ('$nama', '$no_telepon', '$password', '$alamat')";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDataAkun($id){
        $this->db->query("SELECT * FROM ".$this->table." WHERE id_data_customer = ".$id);
        $data = $this->db->single();
        return $data;
    }

    public function getTotalCustomer() {
        $this->db->query("SELECT COUNT(*) as total FROM ".$this->table);
        $result = $this->db->single();
        return $result['total'];
    }
    
}