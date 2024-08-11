<?php
session_start();
class Admin extends Controller {
    public function dashboard()
    {
        $data ['menu'] = $this->model('data_menu')->getTotalMenu();
        $data ['customer'] = $this->model('data_customer')->getTotalCustomer();
        $data ['reservasi'] = $this->model('data_reservasi')->getTotalReservasi();
        $this->view('admin/dashboard', $data);
    }

    public function menu(){
        $data['data_menu'] = $this->model('data_menu')->getDataMenu();
        $this->view('admin/menu', $data);
    }

    public function save_menu() {
        $response = ['success' => false];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_makanan = $_POST['nama_makanan'];
            $harga = $_POST['harga'];

            if (!empty($_FILES['gambar']['name'])) {
                $gambar = $this->uploadImage();
                if ($gambar) {
                    if ($this->model('data_menu')->addMenu($nama_makanan, $harga, $gambar)) {
                        $maxId = $this->model('data_menu')->getMaxId();
                        $response = ['success' => true, 'id' => $maxId];
                    }
                }
            }
        }

        echo json_encode($response);
    }

    public function update_menu() {
        $response = ['success' => false];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nama_makanan = $_POST['nama_makanan'];
            $harga = $_POST['harga'];

            if (!empty($_FILES['gambar']['name'])) {
                $gambar = $this->uploadImage();
                if ($gambar) {
                    if ($this->model('data_menu')->updateMenu($id, $nama_makanan, $harga, $gambar)) {
                        $response['success'] = true;
                    }
                }
            } else {
                if ($this->model('data_menu')->updateMenu($id, $nama_makanan, $harga)) {
                    $response['success'] = true;
                }
            }
        }

        echo json_encode($response);
    }

    public function delete_menu() {
        $response = ['success' => false];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = json_decode(file_get_contents('php://input'), true)['id'];
            if ($this->model('data_menu')->deleteMenu($id)) {
                $response['success'] = true;
            }
        }

        echo json_encode($response);
    }

    private function uploadImage() {
        $target_dir = "C:/xampp/htdocs/Kokago/public/gambar/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        
        if ($check !== false) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                return basename($_FILES["gambar"]["name"]);
            }
        }
        return false;
    }

    public function getMenuById($id) {
        $menu = $this->model('data_menu')->getMenuById($id);
        echo json_encode($menu);
    }

    public function staff(){
        $data ['staff'] = $this->model('data_staff_pelayan')->getDataSemuaStaff();
        $this->view('admin/staff', $data);
    }

    public function save_staff() {
        $response = ['success' => false];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_staff = $_POST['nama_staff'];
            $no_telepon = $_POST['no_telepon'];
            $alamat = $_POST['alamat'];

            if($this->model('data_staff_pelayan')->addStaff($nama_staff, $no_telepon, $alamat)){
                $maxId = $this->model('data_staff_pelayan')->getMaxId();
                $response = ['success' => true, 'id' => $maxId];
            }
        }
        echo json_encode($response);
    }

    public function getStaffById($id) {
        $menu = $this->model('data_staff_pelayan')->getStaffById($id);
        echo json_encode($menu);
    }

    public function update_staff() {
        $response = ['success' => false];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nama_staff = $_POST['nama_staff'];
            $no_telepon = $_POST['no_telepon'];
            $alamat = $_POST['alamat'];

            if ($this->model('data_staff_pelayan')->updateStaff($id, $nama_staff, $no_telepon, $alamat)) {
                $response['success'] = true;
            }
        }
        echo json_encode($response);
    }

    public function delete_staff() {
        $response = ['success' => false];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = json_decode(file_get_contents('php://input'), true)['id'];
            if ($this->model('data_staff_pelayan')->deleteStaff($id)) {
                $response['success'] = true;
            }
        }

        echo json_encode($response);
    }

    public function denah(){
        $data ['tempat'] = $this->model('data_tempat')->getDataSemuaTempat();
        $data ['denah'] =$this->model('gambar_denah')->getNamaGambarDenah();
        $this->view('admin/denah', $data);
    }

    public function save_tempat() {
        $response = ['success' => false];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $lokasi = $_POST['lokasi'];
            $kapasitas = $_POST['kapasitas'];

            if($this->model('data_tempat')->addTempat($lokasi, $kapasitas)){
                $maxId = $this->model('data_tempat')->getMaxId();
                $response = ['success' => true, 'id' => $maxId];
            }
        }

        echo json_encode($response);
    }

    public function getTempatById($id) {
        $menu = $this->model('data_tempat')->getTempatById($id);
        echo json_encode($menu);
    }

    public function update_tempat() {
        $response = ['success' => false];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $lokasi = $_POST['lokasi'];
            $kapasitas = $_POST['kapasitas'];

            if ($this->model('data_tempat')->updateTempat($id, $lokasi, $kapasitas)) {
                $response['success'] = true;
            }
        }
        echo json_encode($response);
    }

    public function delete_tempat() {
        $response = ['success' => false];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = json_decode(file_get_contents('php://input'), true)['id'];
            if ($this->model('data_tempat')->deleteTempat($id)) {
                $response['success'] = true;
            }
        }

        echo json_encode($response);
    }

    public function simpanGambarDenah()
    {
        $gambar = $_FILES['gambar_denah'];

        // Proses penyimpanan gambar ke dalam folder
        $uploadDir = "C:/xampp/htdocs/Kokago/public/gambar/";
        $namaFile = basename($gambar["name"]);
        $targetFile = $uploadDir . $namaFile;

        // Pindahkan gambar ke lokasi upload
        if (move_uploaded_file($gambar["tmp_name"], $targetFile)) {
            // Simpan nama file gambar ke dalam database
            if($this->model('gambar_denah')->simpanNamaGambarDenah($namaFile)){
                $response['success'] = true;
            }
            echo json_encode($response);
        }
    }

    public function reservasi(){
        $id = $_SESSION['id'];
        $data ['reservasi'] = $this->model('data_reservasi')->getDataReservasi();
        foreach ($data['reservasi'] as &$reservasi) {
            $reservasi['detail_pesanan'] = $this->model('detail_reservasi')->getDetailPesananByIdReservasi($reservasi['id_data_reservasi']);
        }
        $this->view('admin/reservasi', $data);
    }

    public function updateStatus(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_reservasi = $_POST['id_reservasi'];
            $status_reservasi = $_POST['status_reservasi'];
            
            // Panggil model untuk mengubah status reservasi
            $success = $this->model('data_reservasi')->updateStatusReservasi($id_reservasi, $status_reservasi);
            
            // Kirim respons ke client
            echo json_encode(['success' => $success]);
        }
    }
}