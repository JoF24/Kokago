<?php

class Data_reservasi {
    private $table = 'data_reservasi';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function isWaktuAvailable($tanggal, $waktu, $lokasi)
    {
        $this->db->query("SELECT COUNT(*) as count FROM ".$this->table." WHERE tanggal = '$tanggal' AND jam = '$waktu' AND id_data_tempat = '$lokasi'");
        $result = $this->db->single();
        return $result['count'] == 0;
    }

    public function createReservasi($tanggal, $waktu, $lokasi, $jumlah_orang, $bukti_pembayaran)
    {
        $id_data_customer = $_SESSION['id'];
        $this->db->query("INSERT INTO ".$this->table." (tanggal, jam, id_data_tempat, jumlah_orang, bukti_pembayaran, id_data_customer) VALUES ('$tanggal', '$waktu', '$lokasi', '$jumlah_orang', '$bukti_pembayaran', '$id_data_customer')");
        $this->db->execute();
        $this->db->query("SELECT MAX(id_data_reservasi) as max_id FROM ".$this->table);
        $result = $this->db->single();
        $data = $result['max_id']; 
        return $data;        
    }

    public function updateDetailReservasi($id_detail_reservasi, $id_reservasi)
    {
        $this->db->query("UPDATE detail_reservasi SET id_reservasi = '$id_reservasi' WHERE id_detail_reservasi = '$id_detail_reservasi'");
        $this->db->execute();
    }

    public function getDataReservasiById($id){
        $this->db->query("SELECT dr.*, dc.nama_customer, l.lokasi 
                          FROM " . $this->table . " dr 
                          JOIN data_customer dc ON dr.id_data_customer = dc.id_data_customer 
                          JOIN data_tempat l ON dr.id_data_tempat = l.id_data_tempat 
                          WHERE dr.id_data_customer = '$id'");
        $data = $this->db->resultSet();
        return $data;
    }    

    public function getDataReservasi(){
        $this->db->query("SELECT dr.*, dc.nama_customer, l.lokasi 
                          FROM " . $this->table . " dr 
                          JOIN data_customer dc ON dr.id_data_customer = dc.id_data_customer 
                          JOIN data_tempat l ON dr.id_data_tempat = l.id_data_tempat");
        $data = $this->db->resultset();
        return $data;
    }

    public function updateStatusReservasi($id_reservasi, $status){
        // Query untuk mengubah status reservasi
        $this->db->query("UPDATE data_reservasi SET status_reservasi = '$status' WHERE id_data_reservasi = '$id_reservasi'");
        $this->db->execute();
        $data = $this->db->rowCount();
        if($data > 0){
            return true;
        }else{
            return false;
        }
    }

    public function getTotalReservasi() {
        $this->db->query("SELECT COUNT(*) as total FROM ".$this->table);
        $result = $this->db->single();
        return $result['total'];
    }

    
}