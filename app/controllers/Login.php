<?php
session_start();
class Login extends Controller {
    public function index()
    {
        $this->view('login/index');
    }

    public function authenticate() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama = $_POST['nama'];
            $password = $_POST['password'];

            $user = $this->model("data_customer")->login($nama, $password);
            if(empty($user)){
                $user = $this->model("data_staff_pelayan")->login($nama, $password);
                $_SESSION['id'] = $user['id_data_staff_pelayan'];
                $_SESSION['username'] = $nama;
                $_SESSION['jabatan'] = 'Admin';
                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                echo '<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: "Berhasil Login!",
                                timer: 2000,
                                showConfirmButton: false,
                                background: "#D2691E" // Ubah warna background menjadi coklat
                            })
                        });
                        setTimeout(function() {
                            window.location.href = "' . BASEURL . '/admin/dashboard";
                        }, 2000);
                        </script>';
                exit();
            }else{
                $_SESSION['id'] = $user['id_data_customer'];
                $_SESSION['username'] = $nama;
                $_SESSION['jabatan'] = 'Pelanggan';
                echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                echo '<script>
                        $(document).ready(function(){
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: "Berhasil Login!",
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
        } else {
            echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
            echo '<script>
                    $(document).ready(function(){
                        Swal.fire({
                            icon: "error",
                            title: "oops...",
                            text: "Username atau Password Salah",
                        }).then(function() {
                            window.location.href = "'.BASEURL.'/login/index";
                        });
                    });
                    </script>';
            exit();
        }
    }

    public function logout() {
        session_destroy();
        header("Location: " . BASEURL . "/beranda/dashboard");
        exit();
    }
}