<?php

class Detail_reservasi {
    private $table = 'detail_reservasi';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function tambah_ke_keranjang($id_data_menu, $id_pelanggan) {
        $sql = "INSERT INTO " . $this->table . " (id_data_menu, id_pelanggan) VALUES ('$id_data_menu', '$id_pelanggan')";
        $this->db->query($sql);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getDataKeranjang($id){
        $this->db->query("SELECT * FROM ".$this->table." WHERE id_pelanggan = '$id' AND id_reservasi = '0'");
        $data = $this->db->resultset();
        return $data;
    }

    public function updateKeranjang($id_pelanggan, $id_data_menu, $jumlah) {
        $total_harga = $jumlah * $this->getHargaMenu($id_data_menu);
        $this->db->query("UPDATE " . $this->table . " SET jumlah = '$jumlah', total_harga = '$total_harga' WHERE id_pelanggan = '$id_pelanggan' AND id_data_menu = '$id_data_menu'");
        return $this->db->execute();
    }

    private function getHargaMenu($id_data_menu) {
        $this->db->query("SELECT harga_menu FROM data_menu WHERE id_data_menu = '$id_data_menu'");
        $result = $this->db->single();
        return $result['harga_menu'];
    }

    public function hapusItemKeranjang($id_detail_reservasi){
        $sql = "DELETE FROM ".$this->table." WHERE id_detail_reservasi = '$id_detail_reservasi'";
        $this->db->query($sql);
        return $this->db->execute();
    }

    public function getTotalHarga($id){
        $query = "SELECT SUM(total_harga) AS total_harga FROM ".$this->table." WHERE id_pelanggan = '$id' AND id_reservasi = '0'";
        $this->db->query($query);
        $row = $this->db->single();
        $data = $row['total_harga'];
        // Pastikan untuk menangani jika nilai total_harga null (misalnya jika tidak ada transaksi)
        if ($data === null) {
            $data = 0;
        }
        return $data;
    }

    public function getDetailPesananByIdReservasi($id_reservasi)
    {
        $this->db->query("SELECT dp.*, dm.nama_menu 
                          FROM detail_reservasi dp 
                          JOIN data_menu dm ON dp.id_data_menu = dm.id_data_menu 
                          WHERE dp.id_reservasi = '$id_reservasi'");
        $data = $this->db->resultSet();
        return $data;
    }
}