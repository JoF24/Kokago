<?php
session_start();
class Beranda extends Controller {
    public function dashboard()
    {
        $data ['lokasi'] = $this->model('data_tempat')->getDataSemuaTempat();
        $data ['denah'] =$this->model('gambar_denah')->getNamaGambarDenah();
        $this->view('dashboard', $data);
    }

    public function login(){
        $data ['lokasi'] = $this->model('data_tempat')->getDataSemuaTempat();
        $data ['denah'] =$this->model('gambar_denah')->getNamaGambarDenah();
        $this->view('dashboard_login', $data);
    }

    public function menu(){
        $data ['menu'] = $this->model('data_menu')->getDataMenu();
        $this->view('menu', $data);
    }
}