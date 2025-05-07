<?php
    require "session.php";
    require "../koneksi.php";

    $queryKatalog = mysqli_query($con, "SELECT * FROM tb_katalog");
    $jumlahKatalog = mysqli_num_rows($queryKatalog);

    $queryPesanan = mysqli_query($con, "SELECT * FROM tb_pesanan");
    $jumlahPesanan = mysqli_num_rows($queryPesanan);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .kotak {
        border: solid;
    }

    .summary-katalog{
        background-color: #332828;
        border-radius: 15px;
    }

    .summary-pesanan{
        background-color: #878282;
        border-radius: 15px;
    }

    .no-decoration{
        text-decoration: none;
    }
</style>

<body>
    <?php require "navbar.php"; ?>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fa-solid fa-shop"></i> Home
                </li>
            </ol>
        </nav>
        <h2>JWP Wedding Organizer</h2>
        <h3>Halo <?php echo $_SESSION['username']; ?></h3>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-katalog p-3">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-solid fa-boxes-stacked fa-7x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Katalog</h3>
                                <p class="fs-4"><?php echo $jumlahKatalog; ?> Katalog</p>
                                <p><a href="katalog.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="summary-pesanan p-3">
                        <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-solid fa-box-open fa-7x text-black-50"></i>
                                </div>
                                <div class="col-6 text-white">
                                    <h4 class="fs-2">Pesanan</h4>
                                    <p class="fs-4"><?php echo $jumlahPesanan; ?> Pesanan</p>
                                    <p><a href="tabel-pesanan.php" class="text-white no-decoration">Lihat Detail</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>