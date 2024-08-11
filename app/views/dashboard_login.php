<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?=BASEURL;?>/gambar/logo.png" type="image/x-icon">
    <title>Kokago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .navbar{
            color:white;
        }
        .navbar-font{
            color:white;
        }
        .navbar-nav .nav-link.active {
            color: white;
        }
        .background-cover {
            background-image: url("<?=BASEURL;?>/gambar/home_cover.png");
            background-size: cover;
            background-position: center;
        }

        body {
            font-family: 'Miltonian Tattoo', cursive;
        }

        .example-text {
            font-size: 24px;
            color: #000;
        }
        
        .tombol_reservasi {
            background-image: url("<?=BASEURL;?>/gambar/tombol_reservasi.png");
            background-size: cover;
            background-position: center;
            width : 200px;
            height : 35px;
        }

        .tombol_menu {
            background-image: url("<?=BASEURL;?>/gambar/Selengkapnya.png");
            background-size: cover;
            background-position: center;
            width : 200px;
            height : 35px;
        }

        .denah-cover {
            background-image: url("<?=BASEURL;?>/gambar/denah_cover.png");
            background-size: cover;
            background-position: center;
        }

        .d-flex img {
            width: 100%; 
            height: auto; 
            padding: 50px;
        }

        .menu-image {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .menu-image:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .footer-cover {
            background-image: url("<?=BASEURL;?>/gambar/footer.png");
            background-size: cover;
            background-position: center;
        }

        .footer .map {
            height: 200px;
            width: 200px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top" id="navbar" style='background-color: #3C2A21;'>
        <div class="container-fluid">
            <img src="<?= BASEURL; ?>/gambar/logo.png" width="60px" height="50px" style="margin-left: 50px">
            <p class="mt-3" style="margin-left: 20px; font-family: 'Georgia', serif; font-size: 20px; font-weight: 200;">KOPKAM JEMBER</p>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto px-5 nav-underline">
                    <li class="nav-item">
                        <a class="nav-link active navbar-font" aria-current="page" href="<?= BASEURL; ?>/beranda/login">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?= BASEURL;?>/pelanggan/menu">MENU</a>        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?= BASEURL;?>/pelanggan/reservasi">RESERVASI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?= BASEURL;?>/beranda/login#denah-kopi-kampus">DENAH KOPKAM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?= BASEURL;?>/beranda/login#kontak-kami">KONTAK KAMI</a>
                    </li>
                    <li class="nav-item dropdown">
                        <div class="d-flex align-items-center" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <p class="mb-0" style="margin-left: 50px;"><?= $_SESSION['username'] ?></p>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= BASEURL; ?>/login/logout">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex background-cover justify-content-center align-items-center" style="height:600px">
        <div class="d-flex flex-column align-items-center" style="width:1000px;">
            <h1 class="mb-5">Selamat Datang Di Website Reservasi Kopi Kampus</h1>
            <h3 class="mb-5">Jadikan Pertemuan Kalian Lebih Berkesan Dengan Kami !!</h3>
            <h5>Tenang Reservasi Tempat Gratis Kok, Cukup Memesan Produk Kami</h5>
        </div>
    </div>
    <div class="d-flex flex-column" style="background-color:#1A120B;height:450px;">
        <div class="d-flex justify-content-center">
            <h2 class="mt-5" style="color:#D5CEA3">Cara Melakukan Reservasi Tempat</h2>
        </div>
        <div class="row">
            <div class="col">
                <img src="<?=BASEURL;?>/gambar/step1.png" class="img-fluid" alt="Step 1">
            </div>
            <div class="col">
                <img src="<?=BASEURL;?>/gambar/step2.png" class="img-fluid" alt="Step 2">
            </div>
            <div class="col">
                <img src="<?=BASEURL;?>/gambar/step3.png" class="img-fluid" alt="Step 3">
            </div>
            <div class="col">
                <img src="<?=BASEURL;?>/gambar/step4.png" class="img-fluid" alt="Step 4">
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <a href="" class="btn tombol_reservasi" role="button"></a>
        </div>
    </div>
    <div class="d-flex flex-column denah-cover justify-content-center" id="denah-kopi-kampus">
        <div class="d-flex justify-content-center">
            <h2 class="mt-5" style="color:#000000">Denah Kopi Kampus</h2>
        </div>
        <div class="row w-100">
                <div class="col-6">
                    <img src="<?=BASEURL;?>/gambar/<?= $data['denah']; ?>" class="img-fluid" alt="">
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-start" style="margin-top:120px">
                        <div style="width:500px">
                            <h3>
                                <?php foreach ($data['lokasi'] as $keterangan) : ?>
                                    Lokasi <?= $keterangan['lokasi']; ?> dengan kapasitas ± <?= $keterangan['kapasitas']; ?> orang<br>
                                <?php endforeach; ?>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column" style="background-color:#1A120B;height:500px;">
        <div class="d-flex justify-content-center">
            <h2 class="mt-5" style="color:#D5CEA3">Menu</h2>
        </div>
        <div class="row">
            <div class="col">
                <img src="<?=BASEURL;?>/gambar/Minuman.png" class="img-fluid menu-image" alt="Minuman">
            </div>
            <div class="col">
                <img src="<?=BASEURL;?>/gambar/Makanan Berat.png" class="img-fluid menu-image" alt="Makanan Berat">
            </div>
            <div class="col">
                <img src="<?=BASEURL;?>/gambar/Snack.png" class="img-fluid menu-image" alt="Minuman">
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <a href="<?= BASEURL;?>/pelanggan/menu" class="btn tombol_menu" role="button"></a>
        </div>
    </div>
    <footer class="footer" style="background-color:#1A120B;height:420px;" id="kontak-kami">
        <div class="d-flex flex-column footer-cover" style="height:420px; font-family: 'Georgia', serif;">
            <div class="row">
                <div class="col-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.051044863082!2d113.7318139!3d-8.1518407!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0:0x5742fdc492811f!2sKOPI%20KAMPUS%20JEMBER!5e0!3m2!1sen!2sid!4v1626964067859!5m2!1sen!2sid" width="400px" height="200px" style="border:0;margin-left:50px;margin-top:20px" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-6 column" style="color:#FFFFFF;margin-top:20px">
                    <h5>Kontak Kami</h5>
                    <p>Alamat: Jl, Tlogo Wetan, Tawangmangu, Sumbersari, Jember Regency, East Java</p>
                    <p>Maps: <a href="https://goo.gl/maps/XRaVjdRD5nk8nBwL8" target="_blank">goo.gl/maps/XRaVjdRD5nk8nBwL8</a></p>
                    <p>Instagram: <a href="https://www.instagram.com/kopikampus.jbr" target="_blank">@kopikampus.jbr</a></p>
                    <p>CP: 0895329542125</p>
                </div>
            </div>
            <div class="d-flex justify-content-center" style="color:white;">
                <span>Copyright &copy; 2023</span>
                <span>Kopi Kampus</span>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        function initMap() {
            var lokasi = {lat: -8.14987591577593, lng: 113.715829}; // Ganti dengan koordinat lokasi Anda
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: lokasi
            });
            var marker = new google.maps.Marker({
                position: lokasi,
                map: map
            });
        }
    </script>
</body>
</html>