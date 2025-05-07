<?php
    require "session.php";
    require "../koneksi.php";

    $queryPesanan = mysqli_query($con, "SELECT * FROM tb_pesanan");
    $jumlahPesanan = mysqli_num_rows($queryPesanan);
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

    .no-decoration{
        text-decoration: none;
    }

    form div{
        margin-bottom: 5px;
    }

</style>
<body>
        <?php require "navbar.php"; ?>
        <div>
            <h2>Tabel Pesanan</h2>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            <th>Tanggal Acara</th>
                            <th>Alamat</th>
                            <th>Bukti Transfer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if($jumlahPesanan==0){
                                ?>
                                    <tr> 
                                        <td colspan=6 class="text-center">Tidak ada data Pesanan</td>
                                    </tr>
                        <?php
                            }
                            else{
                                $jumlah = 1;
                                while($data=mysqli_fetch_array($queryPesanan)){
                        ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['nomor_telepon']; ?></td>
                                    <td><?php echo $data['email']; ?></td>
                                    <td><?php echo $data['tanggal_acara']; ?></td>
                                    <td><?php echo $data['alamat']; ?></td>
                                    <td><img src="../image/<?php echo $data['bukti_transfer']; ?>" alt="" width="50px"></td>
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