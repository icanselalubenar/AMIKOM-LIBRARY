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
    <title>Home | Amikom Library</title>
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
            <div class="menu mt-5" align="center">
                <div class="row">
                    <a href="create.php" class="btn btn-primary btn-menu" style="margin-right: 40px;"><img width="30" src="https://img.icons8.com/fluency/48/add--v1.png" /> Create</a>
                    <a href="read.php" class="btn btn-warning btn-menu" style="color: white;"><img width="30" src="https://img.icons8.com/fluency/48/search.png" /> View</a>
                </div>
                <br><br>
                <div class="row">
                    <a href="update.php" class="btn btn-success btn-menu" style="margin-right: 40px;"><img width="30" src="https://img.icons8.com/fluency/48/create-new.png" /> Edit</a>
                    <a href="delete.php" class="btn btn-danger btn-menu"><img width="30" src="https://img.icons8.com/fluency/48/filled-trash.png" /> Delete</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>