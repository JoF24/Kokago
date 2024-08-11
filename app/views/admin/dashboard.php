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
                        <div class="d-flex align-items-center" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <a href="<?=BASEURL;?>/admin/dashboard" class="active">HOME</a>
            <a href="<?=BASEURL;?>/admin/menu">MENU</a>
            <a href="<?=BASEURL;?>/admin/staff">STAFF</a>
            <a href="<?=BASEURL;?>/admin/denah">DENAH</a>
            <a href="<?=BASEURL;?>/admin/reservasi">DATA RESERVASI</a>
        </div>
    </div>
    <div class="content">
        <div class="d-flex justify-content-center align-items-center" >
            <div class="d-flex flex-column align-items-center" style="width:1000px;background-color:#1A120B; ">
                <h2>DASHBOARD</h2>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center mt-5">
            <div class="row w-100">
                <div class="col-md-4 mb-4">
                    <div class="card text-white" style="background-color:#3C2A21;">
                        <div class="card-body">
                            <h5 class="card-title">Total Menu</h5>
                            <p class="card-text" id="totalMenu"><?= $data['menu']?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card text-white" style="background-color: #1A120B;">
                        <div class="card-body">
                            <h5 class="card-title">Total Customer</h5>
                            <p class="card-text" id="totalCustomer"><?= $data['customer']?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card text-white" style="background-color: black;">
                        <div class="card-body">
                            <h5 class="card-title">Total Reservasi</h5>
                            <p class="card-text" id="totalReservasi"><?= $data['reservasi']?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
