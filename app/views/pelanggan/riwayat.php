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
    <nav class="navbar navbar-expand-lg sticky-top" id="navbar" style='background-color: #3C2A21;'>
        <div class="container-fluid">
            <img src="<?= BASEURL; ?>/gambar/logo.png" width="60px" height="50px" style="margin-left: 50px">
            <p class="mt-3" style="margin-left: 20px; font-family: 'Georgia', serif; font-size: 20px; font-weight: 200;">KOPKAM JEMBER</p>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav ml-auto px-5 nav-underline">
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?= BASEURL; ?>/beranda/login">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?= BASEURL;?>/pelanggan/menu">MENU</a>        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active navbar-font" aria-current="page" href="<?= BASEURL;?>/pelanggan/reservasi">RESERVASI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?= BASEURL;?>/beranda/login#denah-kopi-kampus">DENAH KOPKAM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?= BASEURL;?>/pelanggan/reservasi#kontak-kami">KONTAK KAMI</a>
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
    <div class="d-flex justify-content-center align-items-center" style="height: 150px;background-color:#1A120B">
        <h1 style="color: #FFFFFF;">Riwayat Reservasi</h1>
    </div>
    <div class="d-flex justify-content-center">
        <div class="accordion mt-5 mb-5" id="reservationAccordion">
            <?php if (!empty($data['reservasi'])): ?>
                <?php foreach ($data['reservasi'] as $index => $reservasi): ?>
                    <div class="accordion-item" style="width: 1000px;">
                        <h2 class="accordion-header" id="heading<?= $index ?>">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="false" aria-controls="collapse<?= $index ?>">
                                Reservasi <?= $index + 1 ?>
                            </button>
                        </h2>
                        <div id="collapse<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index ?>" data-bs-parent="#reservationAccordion">
                            <div class="accordion-body">
                                <ul class="list-group">
                                    <li class="list-group-item">Nama: <?= htmlspecialchars($reservasi['nama_customer']) ?></li>
                                    <li class="list-group-item">Tanggal Reservasi: <?= htmlspecialchars($reservasi['tanggal']) ?></li>
                                    <li class="list-group-item">Jumlah Orang: <?= htmlspecialchars($reservasi['jumlah_orang']) ?></li>
                                    <li class="list-group-item">Lokasi: <?= htmlspecialchars($reservasi['lokasi']) ?></li>
                                    <li class="list-group-item">
                                        Status: <span class="status-text"><?= htmlspecialchars($reservasi['status_reservasi']) ?></span>
                                        <button class="btn btn-sm btn-primary edit-status-button">Edit</button>
                                        <div class="edit-status" style="display: none;">
                                            <input type="text" class="form-control status_reservasi-input" value="<?= htmlspecialchars($reservasi['status_reservasi']) ?>">
                                            <button class="btn btn-sm btn-success save-status-button" data-id="<?= $reservasi['id_data_reservasi'] ?>">Save</button>
                                            <button class="btn btn-sm btn-secondary cancel-status-button">Cancel</button>
                                        </div>
                                    </li>
                                    <li class="list-group-item">Menu:
                                        <ul>
                                            <?php if (!empty($reservasi['detail_pesanan'])): ?>
                                                <?php foreach ($reservasi['detail_pesanan'] as $item): ?>
                                                    <li><?= htmlspecialchars($item['nama_menu']) ?> x<?= htmlspecialchars($item['jumlah']) ?></li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li>Data tidak tersedia</li>
                                            <?php endif; ?>
                                        </ul>
                                    </li>
                                    <li class="list-group-item">
                                        Bukti Pembayaran: <img src="<?= BASEURL . '/gambar/' . $reservasi['bukti_pembayaran'] ?>" alt="Bukti Pembayaran" style="max-width: 200px;">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tidak ada data reservasi.</p>
            <?php endif; ?>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>