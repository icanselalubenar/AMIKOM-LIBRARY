<?php
session_start();
if (isset($_POST['login'])) {
    include "connection.php";
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Username dan password tidak boleh kosong!";
    } else {
        $sql = "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'";
        $hasil = mysqli_query($conn, $sql);
        if ($hasil) {
            if (mysqli_num_rows($hasil) > 0) {
                $data = mysqli_fetch_assoc($hasil);
                $_SESSION['username'] = $data['username'];
                header("location:home.php");
                exit;
            } else {
                $error = "Username dan password salah!";
            }
        } else {
            $error = "Terjadi kesalahan dalam mengakses database.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Amikom Library</title>
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
            </div>
        </nav>

        <?php
        if ($error) {
        ?>
            <div class="alert alert-danger container mt-5" role="alert">
                <?= $error; ?>
            </div>
        <?php
        }
        ?>
        <div class="container">
            <form method="POST">
                <div class="card mt-5">
                    <div class="card-body" align="center">
                        <img width="180" height="180" src="https://img.icons8.com/fluency/500/user-male-circle--v1.png" alt="user-male-circle--v1" />
                        <h5 class="card-title">Login</h5>
                        <br>
                        <div class="form-group">
                            <h6>Username</h6>
                            <input type="text" name="username" class="form-control">
                            <br>
                            <h6>Password</h6>
                            <input type="password" name="password" class="form-control">
                            <br>
                            <button class="btn btn-success" style="width: 50%;" name="login">Login</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>