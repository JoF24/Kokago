<?php

session_start();
class Registrasi extends Controller {
    public function index() {
        $this->view('registrasi/index');
    }

    public function tambah_akun(){
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];
        $password = $_POST['password'];

        // Query SQL untuk menyimpan data anggota
        $sql = $this->model('data_customer')->insert_akun($nama, $no_telepon, $password, $alamat);

        if ($sql > 0) {
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
            echo '<script>
                    $(document).ready(function(){
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Berhasil Registrasi! Silahkan Login",
                            timer: 2000,
                            showConfirmButton: false,
                            background: "#D2691E" // Ubah warna background menjadi coklat
                        })
                    });
                    setTimeout(function() {
                        window.location.href = "' . BASEURL . '/login/index";
                    }, 2000);
                    </script>';
            exit();
        } else {
            echo "Error: ";
        }
    }
}