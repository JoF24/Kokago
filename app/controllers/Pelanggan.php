<?php
session_start();
class Pelanggan extends Controller {
    public function menu()
    {
        $data ['menu'] = $this->model('data_menu')->getDataMenu();
        $this->view('pelanggan/menu', $data);
    }

    public function tambah_keranjang() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_data_menu = $_POST['id_data_menu'];
            $id_pelanggan = $_POST['id_pelanggan'];
    
            // Logika untuk menambahkan barang ke keranjang
            $hasil = $this->model('detail_reservasi')->tambah_ke_keranjang($id_data_menu, $id_pelanggan);
    
            if ($hasil > 0) {
                // Jika berhasil
                echo json_encode(['status' => 'success', 'message' => 'Barang berhasil ditambahkan ke keranjang']);
            } else {
                // Jika gagal
                echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan barang ke keranjang']);
            }
        }
    }

    public function reservasi()
    {
        $id = $_SESSION['id'];
        $data ['keranjang'] = $this->model('detail_reservasi')->getDataKeranjang($id); 
        $this->view('pelanggan/reservasi', $data);
    }

    public function update_keranjang() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_data_menu = $_POST['id_data_menu'];
            $jumlah = $_POST['jumlah'];
            $id_pelanggan = $_SESSION['id']; // Pastikan Anda sudah menyimpan id_pelanggan di sesi
            
            $result = $this->model('detail_reservasi')->updateKeranjang($id_pelanggan, $id_data_menu, $jumlah);
            
            if ($result) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    }

    public function hapus_keranjang() {
        $id_detail_reservasi = $_POST['id_detail_reservasi'];
        // Panggil model untuk menghapus item keranjang
        $result = $this->model('detail_reservasi')->hapusItemKeranjang($id_detail_reservasi);

        if ($result) {
            // Jika penghapusan berhasil, kirim respons JSON
            echo json_encode(['status' => 'success']);
        } else {
            // Jika terjadi kesalahan, kirim respons JSON dengan status error
            echo json_encode(['status' => 'error']);
        }
    }

    public function formulir(){
        $id = $_SESSION['id'];
        $data ['pelanggan'] = $this->model('data_customer')->getDataAkun($id);
        $data ['total_harga'] = $this->model('detail_reservasi')->getTotalHarga($id);
        $data ['keranjang'] = $this->model('detail_reservasi')->getDataKeranjang($id);
        $data ['lokasi'] = $this->model('data_tempat')->getDataSemuaTempat();
        $data ['denah'] =$this->model('gambar_denah')->getNamaGambarDenah();
        $this->view('pelanggan/formulir', $data);
    }

    public function check_waktu_reservasi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validasi input
            if (isset($_POST['tanggal'], $_POST['waktu'], $_POST['lokasi'])) {
                $tanggal = htmlspecialchars($_POST['tanggal']);
                $waktu = htmlspecialchars($_POST['waktu']);
                $lokasi = htmlspecialchars($_POST['lokasi']);
    
                // Panggil model dan periksa ketersediaan
                $available = $this->model('Data_reservasi')->isWaktuAvailable($tanggal, $waktu, $lokasi);
    
                // Set header konten
                header('Content-Type: application/json');
    
                // Kembalikan hasil dalam format JSON
                echo json_encode(['available' => $available]);
            } else {
                // Jika input tidak valid
                header('Content-Type: application/json');
                echo json_encode(['error' => 'Invalid input']);
            }
        } else {
            // Jika metode request bukan POST
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid request method']);
        }
    }

    public function checkout(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tanggal_penyewaan = $_POST['tanggal_penyewaan'];
            $waktu_reservasi = $_POST['waktu_reservasi'];
            $lokasi_reservasi = $_POST['lokasi_reservasi'];
            $jumlah_orang = $_POST['jumlah_orang'];
            $bukti_pembayaran = $_FILES['bukti_pembayaran'];

            // Upload bukti pembayaran
            $target_dir = "C:/xampp/htdocs/Kokago/public/gambar/";
            $namaFile = basename($bukti_pembayaran["name"]);
            $target_file = $target_dir . basename($bukti_pembayaran["name"]);
            move_uploaded_file($bukti_pembayaran["tmp_name"], $target_file);

            // Simpan data reservasi
            $id_reservasi = $this->model('data_reservasi')->createReservasi($tanggal_penyewaan, $waktu_reservasi, $lokasi_reservasi, $jumlah_orang, $namaFile);

            // Update detail reservasi
            $id = $_SESSION['id'];
            $data = $this->model('detail_reservasi')->getDataKeranjang($id);
            foreach ($data as $id_detail_reservasi) {
                $id_detail_reservasi = $id_detail_reservasi['id_detail_reservasi'];
                $this->model('data_reservasi')->updateDetailReservasi($id_detail_reservasi, $id_reservasi);
            }
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
            echo '<script>
                    $(document).ready(function(){
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Berhasil Menambahkan Reservasi !",
                            timer: 2000,
                            showConfirmButton: false,
                            background: "#D2691E" // Ubah warna background menjadi coklat
                        })
                    });
                    setTimeout(function() {
                        window.location.href = "' . BASEURL . '/beranda/login";
                    }, 2000);
                    </script>';
            exit();
        }
    }   

    public function riwayat(){
        $id = $_SESSION['id'];
        $data ['reservasi'] = $this->model('data_reservasi')->getDataReservasiById($id);
        foreach ($data['reservasi'] as &$reservasi) {
            $reservasi['detail_pesanan'] = $this->model('detail_reservasi')->getDetailPesananByIdReservasi($reservasi['id_data_reservasi']);
        }
        $this->view('pelanggan/riwayat', $data);
    }
}