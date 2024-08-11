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
            <a href="<?=BASEURL;?>/admin/denah" class="active">DENAH</a>
            <a href="<?=BASEURL;?>/admin/reservasi">DATA RESERVASI</a>
        </div>
    </div>
    <div class="content">
        <div class="d-flex justify-content-center align-items-center" >
            <div class="d-flex flex-column align-items-center" style="width:1000px;background-color:#1A120B; ">
                <h2>DENAH LOKASI</h2>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Lokasi</th>
                        <th>Kapasitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="denahTableBody">
                    <?php foreach ($data['tempat'] as $tempat) : ?>
                        <tr>
                            <td><?= $tempat['lokasi']; ?></td>
                            <td><?= $tempat['kapasitas']; ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="showEditForm(<?= $tempat['id_data_tempat']; ?>)">Update</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteTempat(<?= $tempat['id_data_tempat']; ?>)">Hapus</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <button class="btn btn-success" onclick="showAddForm()">Tambah</button>
        <div class="col-8" style="padding: 30px;">
            <h5>Upload Gambar Denah: </h5>
        </div>
        <div class="input-group">
            <form id="uploadForm" enctype="multipart/form-data">
                <input type="file" class="form-control" id="inputGroupFile02" name="gambar_denah">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </form>
            <button type="button" class="btn btn-primary" onclick="uploadGambar()">Simpan</button>
        </div>
        
        <!-- Menampilkan gambar denah yang saat ini disimpan -->
        <img src="<?=BASEURL;?>/gambar/<?= $data['denah']; ?>" alt="Gambar Denah" style="margin-top: 20px;" width="500">
        
    </div>
    <!-- Modal Add Tempat -->
    <div class="modal fade" id="addTempatModal" tabindex="-1" role="dialog" aria-labelledby="addTempatModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#3C2A21">
                    <h5 class="modal-title" id="addTempatModalLabel">Tambah Data Tempat</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addTempatForm">
                        <div class="form-group">
                            <label for="lokasi">Nama Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                        </div>
                        <div class="form-group">
                            <label for="kapasitas">Kapasitas</label>
                            <input type="number" class="form-control" id="kapasitas" name="kapasitas" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tempat -->
    <div class="modal fade" id="editTempatModal" tabindex="-1" role="dialog" aria-labelledby="editTempatModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#3C2A21">
                    <h5 class="modal-title" id="editTempatModalLabel">Edit Data Tempat</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editTempatForm">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_lokasi">Nama Lokasi</label>
                            <input type="text" class="form-control" id="edit_lokasi" name="lokasi" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_kapasitas">Kapasitas</label>
                            <input type="number" class="form-control" id="edit_kapasitas" name="kapasitas" required>
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
            $('#addTempatModal').modal('show');
        }

        function showEditForm(id) {
            $.ajax({
                url: '<?= BASEURL; ?>/admin/getTempatById/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#edit_id').val(data.id_data_tempat);
                    $('#edit_lokasi').val(data.lokasi);
                    $('#edit_kapasitas').val(data.kapasitas);
                    $('#editTempatModal').modal('show');
                }
            });
        }

        $('#addTempatForm').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '<?= BASEURL; ?>/admin/save_tempat',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload();
                }
            });
        });

        $('#editTempatForm').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '<?= BASEURL; ?>/admin/update_tempat',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload();
                }
            });
        });

        function deleteTempat(id) {
            if (confirm('Apakah yakin ingin menghapus tempat?')) {
                $.ajax({
                    url: '<?= BASEURL; ?>/admin/delete_tempat',
                    type: 'POST',
                    data: JSON.stringify({id: id}),
                    contentType: 'application/json',
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        }
        function uploadGambar() {
            var formData = new FormData($('#uploadForm')[0]);
    
            $.ajax({
                url: '<?=BASEURL;?>/admin/simpanGambarDenah',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    location.reload();
                }
            });
        }
    </script>
</body>
</html>
