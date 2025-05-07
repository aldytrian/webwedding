<?php
    require "session.php";
    require "../koneksi.php";

    $id = $_GET['a'];

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ;
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

     // Ambil data katalog saat ini dari database
     $query = mysqli_query($con, "SELECT * FROM tb_katalog WHERE id_katalog='$id'");
     $data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Detail</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

    <style>
        form div{
            margin-bottom: 5px;
    }
    </style>

<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-2">
        <h2>Detail Katalog</h2>

        <div class="col-12 col-md-6 mb-5">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama'] ?>" class="form-control" autocomplete=off required>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" value="<?php echo $data['harga']; ?>" name="harga" required>
                </div>
                <div>
                    <label for="currentFoto">Foto Katalog Sekarang</label>
                    <img src="../image/<?php echo $data['foto'] ?>" alt="" width="300px">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                        <?php echo $data['detail']; ?>
                    </textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                </div>
            </form>

            <?php
                if(isset($_POST['simpan'])){
                    $nama = htmlspecialchars($_POST['nama']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if($nama=='' || $harga==''){
            ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama, dan harga wajib diisi
                        </div>
            <?php
                    }
                    else{
                        $queryUpdate = mysqli_query($con, "UPDATE tb_katalog SET nama='$nama', harga='$harga', 
                        detail='$detail' WHERE id_katalog='$id'");

                        if($nama_file!=''){
                            if($image_size > 5000000){
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

                                    $queryUpdate = mysqli_query($con, "UPDATE tb_katalog SET foto='$new_name', nama='$nama', harga='$harga', 
                                    detail='$detail' WHERE id_katalog='$id'");

                                    if($queryUpdate){
            ?>
                                        <div class="alert alert-primary mt-3" role="alert">
                                            Katalog Berhasil DiUpdate
                                        </div>

                                        <meta http-equiv="refresh" content="2; url=katalog.php" />
            <?php
                                    }
                                }
                            }
                        }
                    }
                }

                if(isset($_POST['hapus'])){
                    $queryHapus = mysqli_query($con, "DELETE FROM tb_katalog WHERE id_katalog='$id' ");

                    if($queryHapus){
            ?>
                        <div class="alert alert-primary mt-3" role="alert">
                                    Katalog Berhasil Dihapus
                                </div>

                                <meta http-equiv="refresh" content="1; url=katalog.php" />
            <?php
                    }
                } 
            ?>
        </div>
    </div>

<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>