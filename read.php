<?php
session_start();
include "connection.php";
$username = $_SESSION['username'];
if (!isset($username)) {
    header("location:login.php");
}

$sql = "SELECT * FROM `admin` WHERE `username` = '$username'";
$hasil = mysqli_query($conn, $sql);
if ($hasil) {
    $data = mysqli_fetch_assoc($hasil);
} else {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View | Amikom Library</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="home">
        <nav class="navbar bg-light">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">
                    <img src="img/AMIKOM.png" alt="amikom.png" width="40px">
                    AMIKOM Library
                </span>
                <div class="nav-menu">
                    <a href="home.php">Home</a>
                    |
                    <a href="#">Library</a>
                    |
                    <a href="#">About</a>
                </div>
                <div class="logout">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="mt-5" style="width: 50%;" align="center">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Judul</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $v1 = "SELECT * FROM `buku` ORDER BY `id`";
                        $v2 = mysqli_query($conn, $v1);
                        $num = 1;
                        while ($v3 = mysqli_fetch_assoc($v2)) {
                            $k1 = "SELECT `kategori` FROM `kategori`,`buku` WHERE `kategori`.`kode` = `buku`.`kodeKategori`";
                            $k2 = mysqli_query($conn, $k1);
                            $k3 = mysqli_fetch_assoc($k2);

                            if ($v3['umur'] == "<") {
                                $umur = "Dibawah 18 Tahun.";
                            } else if ($v3['umur'] == ">") {
                                $umur = "Diatas 18 Tahun.";
                            }

                            $tahun = substr($v3['thnTerbit'], 0, 4);
                        ?>
                            <tr>
                                <th scope="row"><?= $num; ?></th>
                                <td><?= $v3['judul']; ?></td>
                                <td><button data-bs-toggle="modal" data-bs-target="#details<?= $v3['id']; ?>" class="btn btn-light"><img width="20" src="https://img.icons8.com/fluency/48/search-in-list.png" /> Detail</button></td>
                                <td><a href="uploads/<?= $v3['namaFile']; ?>" class="btn btn-light" download="<?= $v3['namaFile']; ?>"><img width="20" src="https://img.icons8.com/fluency/48/download-2.png" /> Download</a></td>

                                <div class="modal fade" id="details<?= $v3['id']; ?>" tabindex="-1" aria-labelledby="details" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content" align="left">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel"><?= $v3['judul']; ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6>Kategori : <?= $k3['kategori']; ?>.</h6>
                                                <h6>Deskripsi : <?= $v3['deskripsi']; ?>.</h6>
                                                <h6>Penulis : <?= $v3['penulis']; ?>.</h6>
                                                <h6>Penerbit : <?= $v3['penerbit']; ?>.</h6>
                                                <h6>Tahun Terbit : <?= $tahun; ?></h6>
                                                <h6>Umur : <?= $umur; ?></h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        <?php
                            $num++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>