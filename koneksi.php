<?php
$konek = mysqli_connect("localhost", "root", "", "latihanapppenggajian");

if (!$konek) {
    echo "Koneksi ke MySQL Gagal: " . mysqli_connect_error();
    exit();
}
?>
