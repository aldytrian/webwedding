<?php
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryKatalog = mysqli_query($con, "Select * from tb_katalog where nama='$nama'");
    $katalog = mysqli_fetch_array($queryKatalog);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- detail katalog -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-3">
                    <img src="image/<?php echo $katalog['foto']; ?>" class="w-100" alt="">
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1><?php echo $katalog['nama']; ?></h1>
                    <p class="fs-5">
                        <?php echo $katalog['detail']; ?>
                    </p>
                    <p class="text-harga">
                        Rp <?php echo $katalog['harga']; ?>
                    </p>
                    <a href="form-pesanan.php?nama=<?php echo $katalog['nama']; ?>" class="btn warna3 text-white">Pesan</a>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require "footer.php"; ?>
    
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>