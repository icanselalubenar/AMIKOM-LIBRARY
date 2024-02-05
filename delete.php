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

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $file = $_POST['file'];
    unlink("uploads/" . $file);

    $u = "DELETE FROM `buku` WHERE `id`='$id'";
    if ($conn->query($u)) {
        $done = "Data berhasil dihapus.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete | Amikom Library</title>
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
                        ?>
                            <tr>
                                <form method="post">
                                    <th scope="row"><?= $num; ?></th>
                                    <td><?= $v3['judul']; ?></td>

                                    <input type="text" name="id" value="<?= $v3['id']; ?>" hidden>
                                    <input type="text" name="file" value="<?= $v3['namaFile']; ?>" hidden>

                                    <td><button name="delete" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin?')"><img width="30" src="https://img.icons8.com/fluency/48/filled-trash.png" /> Delete</button></td>
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