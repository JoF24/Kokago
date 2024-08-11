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
        body {
            font-family: 'Miltonian Tattoo', cursive;
        }

        .example-text {
            font-size: 24px;
            color: #000;
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
    <nav class="navbar navbar-expand-lg sticky-top" id="navbar" style='background-color:#3C2A21;'>
        <div class="container-fluid">
            <img src="<?=BASEURL;?>/gambar/logo.png" width="60px" height="50px" style="margin-left:50px">
            <p class="mt-3" style="margin-left:20px;font-family: 'Georgia', serif;font-size:20px;font-weight:200px">KOPKAM JEMBER</p>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto px-5 nav-underline">
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?=BASEURL;?>/beranda/dashboard" >HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active navbar-font" aria-current="page"  href="<?=BASEURL;?>/beranda/menu">MENU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?=BASEURL?>/login/index">RESERVASI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?=BASEURL?>/login/index">DENAH KOPKAM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?=BASEURL?>/login/index">KONTAK KAMI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?=BASEURL?>/login/index">LOGIN</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex justify-content-center align-items-center" style="height: 150px;background-color:darkkhaki">
        <h1>Daftar Menu</h1>
    </div>
    <div class="d-flex mb-5" style="margin-left: 100px;">
        <div class="row w-100">
            <?php 
            if($data['menu']!= null){
                foreach($data['menu'] as $dt): ?>
                    <div class="col-3 mt-3">
                        <div class="card" style="height: 320px; width: 260px;">
                            <img src="<?= BASEURL; ?>/gambar/<?= $dt['gambar']; ?>" style="width: 255px;height:200px">
                            <p class="tulisan mt-3" style="margin-left: 15px;font-weight: 600;font-size: 17px;"><?= $dt['nama_menu']; ?></p>
                            <p class="tulisan" style="margin-left: 15px;font-size: 15px;">Rp<?= number_format($dt['harga_menu'], 0, ',', '.'); ?></p>
                        </div>
                    </div>
                <?php endforeach;
            }?>
        </div>
    </div>
    <footer class="footer" style="background-color:#1A120B;height:420px;">
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
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