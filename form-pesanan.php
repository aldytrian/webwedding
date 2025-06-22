<?php
    require "koneksi.php";

    $nama = htmlspecialchars($_GET['nama']);
    $queryKatalog = mysqli_query($con, "SELECT * FROM tb_katalog WHERE nama='$nama'");
    $katalog =mysqli_fetch_array($queryKatalog);

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
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
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 mb-3 my-5 col-12 col-md-6">
        <div class="container">
            <div class="row">Transfer
    <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" >
                </div>
                <div>
                    <label for="nomor_telepon">Nomor Telepon</label>
                    <input type="number" class="form-control" name="nomor_telepon" >
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" autocomplete="off" >
                </div>
                <div>
                    <label for="tanggal_acara">Tanggal Acara</label>
                    <input type="date" name="tanggal_acara" id="tanggal_acara" class="form-control" required>
                </div>
                <div>
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <label for="foto">Bukti Transfer</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>

            <?php
                if (isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $nomor_telepon = htmlspecialchars($_POST['nomor_telepon']);
                    $email = htmlspecialchars($_POST['email']);
                    $tanggal_acara = htmlspecialchars($_POST['tanggal_acara']);
                    $alamat = htmlspecialchars($_POST['alamat']);

                    $target_dir = "image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if($nama=='' || $nomor_telepon=='' || $email==''){
            ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            wajib diisi
                        </div>
            <?php
                    }
                    else{
                        if($nama_file!=''){
                            if($image_size > 10000000){
            ?>
                               <div class="alert alert-warning mt-3" role="alert">
                                    File tidak boleh lebih dari 5 mb
                                </div> 
            <?php
                            }
                            else{
                                if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'gif'){
            ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        File berformat jpg, png, atau gif
                                    </div>
            <?php
                                }
                                else{
                                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                                }
                            }  
                        }

                        // query insert to produk table
                        $queryTambah = mysqli_query($con, "INSERT INTO tb_pesanan (nama, nomor_telepon, email, tanggal_acara, alamat, bukti_transfer) VALUES ('$nama', '$nomor_telepon', '$email', '$tanggal_acara', '$alamat', '$new_name')");

                        if($queryTambah){
            ?>
                            <div class="alert alert-primary mt-3" role="alert">
                                Berhasil
                            </div>
                            <meta http-equiv="refresh" content="5; url=katalog.php" />
            <?php
                        }
                    }
                }
            ?>
            </div>
        </div>
    </div>




    <?php require "footer.php"; ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>
</html>