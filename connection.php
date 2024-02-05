<?php
$conn = mysqli_connect("localhost", "root", "", "library");
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
