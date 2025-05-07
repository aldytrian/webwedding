<?php
    require "koneksi.php";
    $queryKatalog = mysqli_query($con, "SELECT id_katalog, nama, harga, foto, detail FROM tb_katalog LIMIT 3")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JWP Wedding Organizer | Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center">
    </div>

    <!-- katalog -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Katalog</h3>

            <div class="row mt-5">
                <?php while($data = mysqli_fetch_array($queryKatalog)){ ?>
                <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="image-box">
                            <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $data['nama']; ?></h4>
                            <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
                            <p class="card-text text-harga">Rp <?php echo $data['harga']; ?></p>
                            <a href="katalog-detail.php?nama=<?php echo $data['nama']; ?>" class="btn warna4 text-black">See Detail</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-warning fs-5" href="katalog.php">See More</a>
        </div>
    </div>

    <!-- tentang kami -->
    <div class="container-fluid warna4 py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-6 mt-3">
            Selamat datang di JWP Wedding Organizer, tempat di mana impian pernikahan Anda menjadi kenyataan. Dengan pengalaman bertahun-tahun, 
            tim kami yang berdedikasi memastikan setiap detail sempurna, mulai dari perencanaan hingga pelaksanaan. Kami menawarkan layanan yang 
            dipersonalisasi sesuai dengan gaya dan preferensi unik Anda, memastikan perayaan yang bebas stres dan berkesan. Misi kami adalah 
            menciptakan momen tak terlupakan yang mencerminkan kisah cinta Anda. Percayakan pada kami untuk menghadirkan keanggunan, kreativitas, 
            dan profesionalisme pada hari istimewa Anda. Terima kasih telah memilih AL Wedding Organizer – mitra Anda dalam merangkai pernikahan 
            yang indah.
            </p>
        </div>
    </div>

    <!-- footer -->
    <?php require "footer.php"; ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>