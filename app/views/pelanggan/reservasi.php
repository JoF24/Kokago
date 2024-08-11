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
        <h1 style="color: #FFFFFF;">Reservasi</h1>
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
    <div class="container mt-5" style="height: 500px;">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga Total</th>
                    <th scope="col">Aksi</th>
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
                            <input type="number" class="form-control jumlah" data-id="<?= $produk['id_data_menu']; ?>" value="<?= $produk['jumlah']; ?>" min="1">
                        </td>
                        <td class="harga-total" data-harga="<?= $produk['harga_menu']; ?>">Rp <?= number_format($total_harga, 0, ',', '.'); ?></td>
                        <td>
                            <form class="hapus-item-form">
                                <input type="hidden" name="id_detail_reservasi" value="<?= $produk['id_detail_reservasi']; ?>">
                                <button type="button" class="btn btn-danger hapus-item">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-right">
            <a href="<?=BASEURL;?>/pelanggan/formulir" type="button" class="btn btn-primary" role="button">Checkout</a>
            <a href="<?=BASEURL;?>/pelanggan/riwayat" type="button" class="btn btn-warning" role="button">Riwayat</a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function(){
            $('.jumlah').change(function(){
                var row = $(this).closest('tr');
                var id_data_menu = $(this).data('id');
                var jumlah = row.find('.jumlah').val();
                var harga_menu = row.find('.harga-total').data('harga');
                var harga_total = harga_menu * jumlah;
    
                row.find('.harga-total').text('Rp ' + harga_total.toLocaleString('id-ID'));
    
                $.ajax({
                    url: '<?= BASEURL; ?>/pelanggan/update_keranjang',
                    type: 'POST',
                    data: { 
                        id_data_menu: id_data_menu,
                        jumlah: jumlah
                    },
                    success: function(response){
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Keranjang berhasil diperbarui!",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr, status, error){
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: "Terjadi kesalahan saat memperbarui keranjang.",
                        });
                    }
                });
            });
            $('.hapus-item').click(function(){
                var idDetailReservasi = $(this).closest('.hapus-item-form').find('input[name="id_detail_reservasi"]').val();
                var $this = $(this); // Simpan referensi this
                $.ajax({
                    url: '<?= BASEURL; ?>/pelanggan/hapus_keranjang',
                    type: 'POST',
                    data: { id_detail_reservasi: idDetailReservasi },
                    success: function(response){
                        $this.closest('tr').remove();
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            text: "Keranjang berhasil diperbarui!",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr, status, error){
                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: "Terjadi kesalahan saat memperbarui keranjang.",
                        });
                    }
                });
            });
        }); 
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