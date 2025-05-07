<?php
    require "koneksi.php";

    // get katalog by nama katalog/keyword
    if(isset($_GET['keyword'])){
        $queryKatalog = mysqli_query($con, "select * from katalog where nama like '%$_GET[keyword]%'");
    }
    
    // get katalog default
    else{
        $queryKatalog = mysqli_query($con, "select * from tb_katalog");
    }

    $countData = mysqli_num_rows($queryKatalog);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JWP Wedding Organizer | Katalog</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    <?php require "navbar.php"; ?>

    <!-- banner -->
    <div class="container-fluid banner2 d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center">Katalog</h1>
        </div>
    </div>

    <!-- body -->
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-1 mb-4">
               
            </div>
            <div class="col-lg-9">
                <h3 class="text-center mb-3">Katalog</h3>
                <div class="row">
                    <?php
                        if($countData<1){
                    ?>
                        <h4 class="text-center my-5">Katalog yang anda cari tidak tersedia</h4>
                    <?php
                        }
                    ?>
                    <?php while($katalog = mysqli_fetch_array($queryKatalog)){ ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="image/<?php echo $katalog['foto']; ?>" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $katalog['nama']; ?></h4>
                                <p class="card-text text-truncate"><?php echo $katalog['detail']; ?></p>
                                <p class="card-text text-harga">Rp <?php echo $katalog['harga']; ?></p>
                                <a href="katalog-detail.php?nama=<?php echo $katalog['nama']; ?>" class="btn warna4 text-black">See Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php }  ?>
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