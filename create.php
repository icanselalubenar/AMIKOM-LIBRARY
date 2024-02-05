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


if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $thnTerbit = $_POST['tahun'];
    $umur = $_POST['umur'];

    $uploadDir = "uploads/";
    $uploadedFile = $uploadDir . basename($_FILES["file"]["name"]);
    $fileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
    $rename = strtolower(str_replace(' ', '-', $judul));
    $file = $rename . "." . $fileType;
    if (isset($_FILES["file"])) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadDir . $file)) {
            $u = "INSERT INTO `buku` VALUES (NULL, '$judul', '$kategori', '$deskripsi', '$penulis', '$penerbit', '$thnTerbit', '$umur', '$file')";
            $conn->query($u);
            $done = "Seluruh data berhasil diunggah";
        } else {
            $error = "Gagal mengunggah data.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create | Amikom Library</title>
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
        $k1 = "SELECT * FROM `kategori`";
        $k2 = mysqli_query($conn, $k1);

        if ($done) {
        ?>
            <div class="alert alert-success container mt-5" role="success">
                <?= $done; ?>
            </div>
        <?php
        } else if ($error) {
        ?>
            <div class="alert alert-danger container mt-5" role="alert">
                <?= $error; ?>
            </div>
        <?php
        }
        ?>
        <div class="container">
            <form method="POST" enctype="multipart/form-data">
                <div class="card mt-5 mb-5">
                    <div class="card-body" align="center">
                        <h5 class="card-title">Input Data Buku</h5>
                        <br>
                        <div class="form-group">
                            <div class="form-floating">
                                <input type="text" name="judul" id="judulFloating" class="form-control" placeholder="Masukan Judul Buku" require>
                                <label for="judulFloating">Judul Buku</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <select class="form-select" id="floatingSelect" name="kategori" require>
                                    <option selected disabled>Pilih..</option>
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
                                <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" id="floatingTextarea2" style="height: 100px" require></textarea>
                                <label for="floatingTextarea2">Deskripsi</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="text" name="penulis" id="penulisFloating" class="form-control" placeholder="Masukan Penulis Buku" require>
                                <label for="penulisFloating">Penulis Buku</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="text" name="penerbit" id="penerbitFloating" class="form-control" placeholder="Masukan Penerbit Buku" require>
                                <label for="penerbitFloating">Penerbit Buku</label>
                            </div>
                            <br>
                            <div class="form-floating">
                                <input type="date" name="tahun" id="tahunFloating" class="form-control" placeholder="Masukan Tahun Terbit Buku" require>
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
                            <div align="left">
                                <label for="fileUpload">Upload File Buku</label>
                                <input type="file" name="file" id="fileUpload" class="form-control" placeholder="Masukan File Buku" require>
                            </div>
                            <br>
                            <button class="btn btn-success mb-3" style="width: 50%;" name="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>