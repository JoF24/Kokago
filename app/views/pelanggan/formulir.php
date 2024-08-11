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
                        <a class="nav-link navbar-font"  href="<?= BASEURL;?>/pelanggan/menu">MENU</a>        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active navbar-font" aria-current="page" href="<?= BASEURL;?>/pelanggan/reservasi">RESERVASI</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?= BASEURL;?>/beranda/login#denah-kopi-kampus">DENAH KOPKAM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbar-font" href="<?= BASEURL;?>/pelanggan/formulir#kontak-kami">KONTAK KAMI</a>
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
    <div class="d-flex justify-content-center align-items-center" style="height: 150px;background-color:darkkhaki">
        <h1>Formulir Reservasi</h1>
    </div>
    <?php
    $produkKeranjang = [];
    foreach ($data['keranjang'] as $item) {
        $id_detail_reservasi = $item['id_detail_reservasi'];
        $id_data_menu = $item['id_data_menu'];
        $produk = $this->model('data_menu')->getDataMenuById($id_data_menu); // Mengambil data alat kemah berdasarkan id_alat
        $produk['jumlah'] = $item['jumlah'];
        $produk['id_detail_reservasi'] = $id_detail_reservasi;
        $produkKeranjang[] = $produk;
    }
    ?>
    <div class="d-flex justify-content-center">
        <form action="<?= BASEURL; ?>/pelanggan/checkout" method="post" style="width: 700px;" enctype="multipart/form-data" >
            <!-- Informasi Pelanggan (Otomatis Terisi) -->
            <div class="form-group mt-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['pelanggan']['nama_customer']; ?>" readonly>
            </div>
            <div class="form-group mt-3">
                <label for="telepon">Nomor Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $data['pelanggan']['no_telepon_customer']; ?>" readonly>
            </div>
            <div class="form-group mt-3">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" readonly><?= $data['pelanggan']['alamat_customer']; ?></textarea>
            </div>
            <div class="form-group mt-3 d-flex flex-column align-items-center">
                <label for="daftar_pesanan">Daftar Pesanan</label>
                <div class="container mt-5" style="height: auto;">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($produkKeranjang as $produk) :
                                $total_harga = $produk['harga_menu'] * $produk['jumlah'];
                                ?>
                                <tr>
                                    <th scope="row"><?= $no++; ?></th>
                                    <td><img src="<?= BASEURL; ?>/gambar/<?= htmlspecialchars($produk['gambar'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($produk['nama_menu'], ENT_QUOTES, 'UTF-8'); ?>" width="100"></td>
                                    <td><?= htmlspecialchars($produk['nama_menu'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td>
                                        <input type="number" class="form-control jumlah" data-id="<?= $produk['id_data_menu']; ?>" value="<?= $produk['jumlah']; ?>" readonly>
                                    </td>
                                    <td class="harga-total" data-harga="<?= $produk['harga_menu']; ?>">Rp <?= number_format($total_harga, 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Informasi Keranjang (Harga Total) -->
            <div class="form-group mt-3">
                <label for="harga_total">Harga Total Keranjang</label>
                <input type="text" class="form-control" id="harga_total" name="harga_total" value="Rp <?= number_format($data['total_harga'], 0, ',', '.'); ?>" readonly>
            </div>
        
            <!-- Input Bukti Pembayaran -->
            <div class="form-group d-flex flex-column mt-3">
                <label for="bukti_pembayaran">Bukti Pembayaran</label>
                <input type="file" class="form-control-file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
            </div>
        
            <!-- Input Tanggal Penyewaan -->
            <div class="form-group mt-3">
                <label for="tanggal_penyewaan">Tanggal Reservasi</label>
                <input type="date" class="form-control" id="tanggal_penyewaan" name="tanggal_penyewaan" required>
            </div>
            <!-- Pilih Waktu Reservasi -->
            <div class="form-group mt-3">
                <label for="waktu_reservasi">Waktu Reservasi</label>
                <select class="form-control" id="waktu_reservasi" name="waktu_reservasi" required>
                    <option hidden disabled selected>Pilih Waktu Reservasi</option>
                    <option value="09:00 - 12:00">09:00 - 12:00</option>
                    <option value="12:00 - 15:00">12:00 - 15:00</option>
                    <option value="15:00 - 18:00">15:00 - 18:00</option>
                    <option value="18:00 - 21:00">18:00 - 21:00</option>
                    <option value="21:00 - 00:00">21:00 - 00:00</option>
                </select>
                <div id="waktu-error" class="text-danger mt-2" style="display: none;">Waktu sudah dipesan, silakan pilih waktu lain.</div>
            </div>
            <!-- Input Jumlah Orang -->
            <div class="form-group mt-3">
                <label for="jumlah_orang">Jumlah Orang</label>
                <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" min="0" required>
                <div id="jumlah-error" class="text-danger mt-2" style="display: none;">Jumlah orang melebihi kapasitas, silakan kurangi jumlah orang atau pilih lokasi lain.</div>
            </div>
            <!-- Pilih Lokasi Reservasi -->
            <div class="form-group mt-3">
                <label for="lokasi_reservasi">Lokasi Reservasi</label>
                <select class="form-control" id="lokasi_reservasi" name="lokasi_reservasi" required>
                    <option hidden disabled selected>Pilih Lokasi Reservasi</option>
                    <?php foreach ($data['lokasi'] as $lokasi) : ?>
                        <option value="<?= $lokasi['id_data_tempat']; ?>"><?= htmlspecialchars($lokasi['lokasi'], ENT_QUOTES, 'UTF-8'); ?> Kapasitas : <?=$lokasi['kapasitas'];?></option>
                    <?php endforeach; ?>
                </select>
                <img src="<?=BASEURL;?>/gambar/<?= $data['denah']; ?>" alt="Gambar Denah" style="margin-top: 20px;" width="500">
            </div>
            
            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary mt-3 mb-5">Checkout</button>
        </form>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            function checkAvailability() {
                var tanggal = $('#tanggal_penyewaan').val();
                var waktu = $('#waktu_reservasi').val();
                var lokasi = $('#lokasi_reservasi').val();
                var kapasitas = $('#lokasi_reservasi option:selected').data('kapasitas');
                var jumlahOrang = $('#jumlah_orang').val();

                if (tanggal && waktu && lokasi && jumlahOrang) {
                    // Cek kapasitas
                    if (parseInt(jumlahOrang) > parseInt(kapasitas)) {
                        $('#jumlah-error').show();
                        $('button[type="submit"]').prop('disabled', true);
                    } else {
                        $('#jumlah-error').hide();
                        $.ajax({
                            url: '<?= BASEURL; ?>/pelanggan/check_waktu_reservasi',
                            type: 'POST',
                            dataType: 'json',  // Tambahkan tipe data
                            data: {
                                tanggal: tanggal,
                                waktu: waktu,
                                lokasi: lokasi
                            },
                            success: function(response) {
                                if (response.available) {
                                    $('#waktu-error').hide();
                                    $('button[type="submit"]').prop('disabled', false);
                                } else {
                                    $('#waktu-error').show();
                                    $('button[type="submit"]').prop('disabled', true);
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan saat memeriksa waktu reservasi.');
                            }
                        });
                    }
                }
            }

            $('#waktu_reservasi, #tanggal_penyewaan, #lokasi_reservasi, #jumlah_orang').on('change', checkAvailability);
        });
    </script>

</body>
</html>