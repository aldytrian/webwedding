<?php
    require "session.php";
    require "../koneksi.php";

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
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
    <title>JWP Wedding Organizer/Katalog</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
</head>

<style>
    .no-decoration {
        text-decoration: none;
    }

    form div {
        margin-bottom: 5px;
    }
</style>

<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="no-decoration text-muted">
                        <i class="fa-solid fa-shop"></i> Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-solid fa-box-open fa text-black-50"></i> Katalog
                </li>
            </ol>
        </nav>

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Katalog</h3>

            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required>
                </div>
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" name="harga" required>
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>

            <?php
                if (isset($_POST['simpan'])) {
                    $nama = htmlspecialchars($_POST['nama']);
                    $harga = htmlspecialchars($_POST['harga']);
                    $detail = htmlspecialchars($_POST['detail']);

                    $target_dir = "../image/";
                    $nama_file = basename($_FILES["foto"]["name"]);
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $image_size = $_FILES["foto"]["size"];
                    $random_name = generateRandomString(20);
                    $new_name = $random_name . "." . $imageFileType;

                    if ($nama == '' || $harga == '') {
            ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Nama dan harga wajib diisi
                        </div>
            <?php
                    } else {
                        if ($nama_file != '') {
                            if ($image_size > 5000000) {
            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File tidak boleh lebih dari 5 MB
                                </div>
            <?php
                            } else {
                                $allowed_types = ['jpg', 'png', 'gif'];
                                if (!in_array($imageFileType, $allowed_types)) {
            ?>
                                    <div class="alert alert-warning mt-3" role="alert">
                                        File harus berformat jpg, png, atau gif
                                    </div>
            <?php
                                } else {
                                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name)) {
                                        $queryTambah = $con->prepare("INSERT INTO tb_katalog (nama, harga, foto, detail) VALUES (?, ?, ?, ?)");
                                        $queryTambah->bind_param("siss", $nama, $harga, $new_name, $detail);

                                        if ($queryTambah->execute()) {
            ?>
                                            <div class="alert alert-primary mt-3" role="alert">
                                                Katalog Berhasil Disimpan
                                            </div>

                                            <meta http-equiv="refresh" content="1; url=katalog.php" />
            <?php
                                        } else {
                                            echo "Error: " . $con->error;
                                        }
                                    } else {
            ?>
                                        <div class="alert alert-warning mt-3" role="alert">
                                            Terjadi kesalahan saat mengunggah file
                                        </div>
            <?php
                                    }
                                }
                            }
                        } else {
                            $queryTambah = $con->prepare("INSERT INTO tb_katalog (nama, harga, detail) VALUES (?, ?, ?)");
                            $queryTambah->bind_param("sis", $nama, $harga, $detail);

                            if ($queryTambah->execute()) {
            ?>
                                <div class="alert alert-primary mt-3" role="alert">
                                    Katalog Berhasil Disimpan
                                </div>

                                <meta http-equiv="refresh" content="1; url=katalog.php" />
            <?php
                            } else {
                                echo "Error: " . $con->error;
                            }
                        }
                    }
                }
            ?>
        </div>

        <div class="mt-3 mb-5">
            <h2>List Katalog</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = mysqli_query($con, "SELECT * FROM tb_katalog");
                            $jumlahKatalog = mysqli_num_rows($query);

                            if ($jumlahKatalog == 0) {
                        ?>
                                <tr>
                                    <td colspan="4" class="text-center">Data Katalog tidak tersedia</td>
                                </tr>
                        <?php
                            } else {
                                $jumlah = 1;
                                while ($data = mysqli_fetch_array($query)) {
                        ?>
                                    <tr>
                                        <td><?php echo $jumlah; ?></td>
                                        <td><?php echo htmlspecialchars($data['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($data['harga']); ?></td>
                                        <td>
                                            <a href="katalog-detail.php?a=<?php echo ($data['id_katalog']); ?>" 
                                            class="btn btn-info" ><i class="fas fa-search"></i></a>
                                        </td>
                                    </tr>
                        <?php
                                    $jumlah++;
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>
</html>
