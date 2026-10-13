<?php
$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_lapangan_olahraga"
);

if (!$koneksi) {
    die("Koneksi database gagal");
}
echo "Koneksi database berhasil!";
?>