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

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $thnTerbit = $_POST['tahun'];
    $umur = $_POST['umur'];
    $u = "UPDATE `buku` SET `judul`='$judul',`kodeKategori`='$kategori',`deskripsi`='$deskripsi',`penulis`='$penulis',`penerbit`='$penerbit',`thnTerbit`='$thnTerbit',`umur`='$umur' WHERE `id`='$id'";

    if ($conn->query($u)) {
        $done = "Data berhasil diperbarui.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit | Amikom Library</title>
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

        <?php
        if ($done) {
        ?>
            <div class="alert alert-success container mt-5" role="success">
                <?= $done; ?>
            </div>
        <?php
        }
        ?>

        <div class="container">
            <div class="mt-5" style="width: 50%;" align="center">
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Judul</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $v1 = "SELECT * FROM `buku` ORDER BY `id`";
                        $v2 = mysqli_query($conn, $v1);
                        $num = 1;
                        while ($v3 = mysqli_fetch_assoc($v2)) {
                            $k1 = "SELECT * FROM `kategori`";
                            $k2 = mysqli_query($conn, $k1);
                        ?>
                            <tr>

                                <th scope="row"><?= $num; ?></th>
                                <td><?= $v3['judul']; ?></td>
                                <td><button data-bs-toggle="modal" data-bs-target="#details<?= $v3['id']; ?>" class="btn btn-light"><img width="30" src="https://img.icons8.com/fluency/48/pencil-tip.png" /> Edit</button></td>

                                <form method="POST" enctype="multipart/form-data">
                                    <div class="modal fade" id="details<?= $v3['id']; ?>" tabindex="-1" aria-labelledby="details" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content" align="left">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" name="id" value="<?= $v3['id']; ?>" hidden>
                                                        <div class="form-floating">
                                                            <input type="text" name="judul" id="judulFloating" class="form-control" placeholder="Masukan Judul Buku" value="<?= $v3['judul']; ?>" require>
                                                            <label for="judulFloating">Judul Buku</label>
                                                        </div>
                                                        <br>
                                                        <div class="form-floating">
                                                            <select class="form-select" id="floatingSelect" name="kategori" require>
                                                                <option value="<?= $v3['kategori']; ?>" selected disabled>Pilih..</option>
                                                                <?php
                                                                while ($k3 = mysqli_fetch_assoc($k2)) {
                                                                    echo '<option value="' . $k3['kode'] . '">' . $k3['kategori'] . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <label for="floatingSelect">Kategori Buku</label>
                                                        </div>
                                                        <br>
                                                        <div class="form-floating">
                                                            <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="floatingTextarea2" style="height: 100px" require><?= $v3['deskripsi']; ?></textarea>
                                                            <label for="floatingTextarea2">Deskripsi</label>
                                                        </div>
                                                        <br>
                                                        <div class="form-floating">
                                                            <input type="text" name="penulis" id="penulisFloating" class="form-control" placeholder="Masukan Penulis Buku" value="<?= $v3['penulis']; ?>" require>
                                                            <label for="penulisFloating">Penulis Buku</label>
                                                        </div>
                                                        <br>
                                                        <div class="form-floating">
                                                            <input type="text" name="penerbit" id="penerbitFloating" class="form-control" placeholder="Masukan Penerbit Buku" value="<?= $v3['penerbit']; ?>" require>
                                                            <label for="penerbitFloating">Penerbit Buku</label>
                                                        </div>
                                                        <br>
                                                        <div class="form-floating">
                                                            <input type="date" name="tahun" id="tahunFloating" class="form-control" placeholder="Masukan Tahun Terbit Buku" value="<?= $v3['thnTerbit']; ?>" require>
                                                            <label for="tahunFloating">Tahun Terbit Buku</label>
                                                        </div>
                                                        <br>
                                                        <div class="form-check" align="left">
                                                            <input class="form-check-input" type="radio" name="umur" value="<" id="flexRadioDefault1" checked>
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                Umur dibawah 18 tahun.
                                                            </label>
                                                        </div>
                                                        <div class="form-check" align="left">
                                                            <input class="form-check-input" type="radio" name="umur" value=">" id="flexRadioDefault2">
                                                            <label class="form-check-label" for="flexRadioDefault2">
                                                                Umur diatas 18 tahun.
                                                            </label>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button class="btn btn-success" style="width: 50%;" name="update">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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