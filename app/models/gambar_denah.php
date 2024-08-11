<?php

class Gambar_denah {
    private $table = 'gambar_denah';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    // Fungsi untuk mendapatkan nama gambar denah yang saat ini disimpan dari database
    public function getNamaGambarDenah()
    {
        $this->db->query("SELECT gambar FROM ".$this->table." WHERE id_denah = 1");
        $result = $this->db->single();
        return $result['gambar'];
    }

    // Fungsi untuk menyimpan nama file gambar denah ke dalam database
    public function simpanNamaGambarDenah($namaGambar)
    {
        $this->db->query("UPDATE ".$this->table." SET gambar = '$namaGambar' WHERE id_denah = 1");
        // Eksekusi query
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
