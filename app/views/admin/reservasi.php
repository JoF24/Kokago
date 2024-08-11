<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?=BASEURL;?>/gambar/logo.png" type="image/x-icon">
    <title>Kokago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #1A120B;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #D5CEA3;
            display: block;
            text-align: center;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .sidebar .active {
            background-color: #575757;
        }

        .content {
            margin-left: 260px;
            padding: 20px;
        }

        .background-cover {
            background-image: url("gambar/home_cover.png");
            background-size: cover;
            background-position: center;
        }

        body {
            font-family: 'Miltonian Tattoo', cursive;
            color: #D5CEA3;
        }

        .sidebar .logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .navbar .nav-item img {
            width: 40px;
            height: 40px;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand sticky-top" id="navbar" style='background-color:#3C2A21;'>
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <div class="d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <a class="nav-link" href="#"><img src="<?= BASEURL; ?>/gambar/profil.png" alt="Profile Icon"></a>
                            <p class="mb-0" style="margin-left: 15px; color: white;"><?= $_SESSION['username'] ?></p>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= BASEURL; ?>/login/logout">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="sidebar">
        <div class="logo">
            <img src="<?=BASEURL;?>/gambar/logo.png" width="60px" height="50px">
            <p class="mt-3" style="font-family: 'Georgia', serif; font-size: 20px; font-weight: 200px; text-align: center;">KOPKAM JEMBER</p>
        </div>
        <div>
            <a href="<?=BASEURL;?>/admin/dashboard" >HOME</a>
            <a href="<?=BASEURL;?>/admin/menu">MENU</a>
            <a href="<?=BASEURL;?>/admin/staff">STAFF</a>
            <a href="<?=BASEURL;?>/admin/denah">DENAH</a>
            <a href="<?=BASEURL;?>/admin/reservasi" class="active">DATA RESERVASI</a>
        </div>
    </div>
    <div class="content">
        <div class="d-flex justify-content-center align-items-center" >
            <div class="d-flex flex-column align-items-center" style="width:1000px;background-color:#1A120B; ">
                <h2>DATA RESERVASI</h2>
            </div>
        </div>
        <div class="accordion" id="reservationAccordion">
            <?php if (!empty($data['reservasi'])): ?>
                <?php foreach ($data['reservasi'] as $index => $reservasi): ?>
                    <div class="accordion-item">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.edit-status-button').click(function() {
                var parent = $(this).closest('.list-group-item');
                parent.find('.status-text').hide();
                parent.find('.edit-status').show();
                $(this).hide();
            });
    
            $('.cancel-status-button').click(function() {
                var parent = $(this).closest('.list-group-item');
                parent.find('.edit-status').hide();
                parent.find('.status-text').show();
                parent.find('.edit-status-button').show();
            });
    
            $('.save-status-button').click(function() {
                var parent = $(this).closest('.list-group-item');
                var newStatus = parent.find('.status_reservasi-input').val();
                var idReservasi = $(this).data('id');
    
                $.ajax({
                    url: '<?= BASEURL; ?>/admin/updateStatus',
                    type: 'POST',
                    data: {
                        id_reservasi: idReservasi,
                        status_reservasi: newStatus
                    },
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.success) {
                            parent.find('.status-text').text(newStatus);
                            parent.find('.edit-status').hide();
                            parent.find('.status-text').show();
                            parent.find('.edit-status-button').show();
                        } else {
                            alert('Terjadi kesalahan saat memperbarui status.');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat memperbarui status.');
                    }
                });
            });
        });
    </script>
</body>
</html>

