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
            background-image: url("<?=BASEURL;?>/gambar/home_cover.png");
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

        .table th,
        .table td {
            vertical-align: middle;
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
            <a href="<?=BASEURL;?>/admin/menu" class="active">MENU</a>
            <a href="<?=BASEURL;?>/admin/staff">STAFF</a>
            <a href="<?=BASEURL;?>/admin/denah">DENAH</a>
            <a href="<?=BASEURL;?>/admin/reservasi">DATA RESERVASI</a>
        </div>
    </div>
    <div class="content">
        <div class="d-flex justify-content-center align-items-center">
            <div class="d-flex flex-column align-items-center" style="width:1000px;background-color:#1A120B;">
                <h2>MENU</h2>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Makanan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="menuTableBody">
                    <?php foreach ($data['data_menu'] as $menu) : ?>
                        <tr>
                            <td><img src="<?= BASEURL; ?>/gambar/<?= $menu['gambar']; ?>" alt="<?= $menu['nama_menu']; ?>" style="max-width: 100px;"></td>
                            <td><?= $menu['nama_menu']; ?></td>
                            <td><?= $menu['harga_menu']; ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="showEditForm(<?= $menu['id_data_menu']; ?>)">Update</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteMenu(<?= $menu['id_data_menu']; ?>)">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <button class="btn btn-success" onclick="showAddForm()">Tambah</button>
    </div>
    <!-- Modal Add Menu -->
    <div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#D5CEA3">
                    <h5 class="modal-title" id="addMenuModalLabel">Add Menu</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addMenuForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama_makanan">Nama Makanan</label>
                            <input type="text" class="form-control" id="nama_makanan" name="nama_makanan" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Menu -->
    <div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#D5CEA3">
                    <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editMenuForm" enctype="multipart/form-data">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_nama_makanan">Nama Makanan</label>
                            <input type="text" class="form-control" id="edit_nama_makanan" name="nama_makanan" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_harga">Harga</label>
                            <input type="number" class="form-control" id="edit_harga" name="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_gambar">Gambar</label>
                            <input type="file" class="form-control" id="edit_gambar" name="gambar">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        function showAddForm() {
            $('#addMenuModal').modal('show');
        }

        function showEditForm(id) {
            $.ajax({
                url: '<?= BASEURL; ?>/admin/getMenuById/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#edit_id').val(data.id_data_menu);
                    $('#edit_nama_makanan').val(data.nama_menu);
                    $('#edit_harga').val(data.harga_menu);
                    $('#editMenuModal').modal('show');
                }
            });
        }

        $('#addMenuForm').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '<?= BASEURL; ?>/admin/save_menu',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload();
                }
            });
        });

        $('#editMenuForm').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '<?= BASEURL; ?>/admin/update_menu',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload();
                }
            });
        });

        function deleteMenu(id) {
            if (confirm('Apakah yakin ingin menghapus menu?')) {
                $.ajax({
                    url: '<?= BASEURL; ?>/admin/delete_menu',
                    type: 'POST',
                    data: JSON.stringify({id: id}),
                    contentType: 'application/json',
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        }
    </script>
</body>
</html>
