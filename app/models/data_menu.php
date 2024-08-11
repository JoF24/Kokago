<?php

class Data_menu {
    private $table = 'data_menu';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getDataMenu() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function addMenu($nama_makanan, $harga, $gambar) {
        $this->db->query("INSERT INTO " . $this->table . " (nama_menu, harga_menu, gambar) VALUES ('$nama_makanan', '$harga', '$gambar')");
        return $this->db->execute();
    }

    public function updateMenu($id, $nama_makanan, $harga, $gambar = null) {
        if ($gambar) {
            $this->db->query("UPDATE " . $this->table . " SET nama_menu = '$nama_makanan', harga_menu = '$harga', gambar = '$gambar' WHERE id_data_menu = '$id'");
        } else {
            $this->db->query("UPDATE " . $this->table . " SET nama_menu = '$nama_makanan', harga_menu = '$harga' WHERE id_data_menu = '$id'");
        }
        return $this->db->execute();
    }

    public function deleteMenu($id) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id_data_menu = '$id'");
        return $this->db->execute();
    }

    public function getMaxId() {
        $this->db->query('SELECT MAX(id_data_menu) as max_id FROM ' . $this->table);
        return $this->db->single()['max_id'];
    }

    public function getMenuById($id) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id_data_menu = '$id'");
        return $this->db->single();
    }

    public function getDataMenuById($id_data_menu){
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_data_menu = '.$id_data_menu);
        $data = $this->db->single();
        return $data;
    }

    public function getTotalMenu() {
        $this->db->query("SELECT COUNT(*) as total FROM ".$this->table);
        $result = $this->db->single();
        return $result['total'];
    }
}