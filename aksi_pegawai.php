<?php
include "koneksi.php"; // Pastikan Anda menghubungkan ke database

$act = $_GET['act'];

switch ($act) {
    case 'insert':
        $nip = $_POST['nip'];
        $nama_pegawai = $_POST['nama_pegawai'];
        $kode_jabatan = $_POST['kode_jabatan'];
        $kode_golongan = $_POST['kode_golongan'];
        $status = $_POST['status'];
        $jumlah_anak = $_POST['jumlah_anak'];

        $query = "INSERT INTO pegawai (nip, nama_pegawai, kode_jabatan, kode_golongan, status, jumlah_anak) 
                  VALUES ('$nip', '$nama_pegawai', '$kode_jabatan', '$kode_golongan', '$status', '$jumlah_anak')";

        if (mysqli_query($konek, $query)) {
            header('Location: data_pegawai.php?e=sukses');
        } else {
            header('Location: data_pegawai.php?e=gagal');
        }
        break;

    case 'update':
        $nip = $_POST['nip'];
        $nama_pegawai = $_POST['nama_pegawai'];
        $kode_jabatan = $_POST['kode_jabatan'];
        $kode_golongan = $_POST['kode_golongan'];
        $status = $_POST['status'];
        $jumlah_anak = $_POST['jumlah_anak'];

        $query = "UPDATE pegawai SET 
                  nama_pegawai='$nama_pegawai', 
                  kode_jabatan='$kode_jabatan', 
                  kode_golongan='$kode_golongan', 
                  status='$status', 
                  jumlah_anak='$jumlah_anak' 
                  WHERE nip='$nip'";

        if (mysqli_query($konek, $query)) {
            header('Location: data_pegawai.php?e=sukses');
        } else {
            header('Location: data_pegawai.php?e=gagal');
        }
        break;

    case 'del':
        $nip = $_GET['id'];
        $query = "DELETE FROM pegawai WHERE nip='$nip'";

        if (mysqli_query($konek, $query)) {
            header('Location: data_pegawai.php?e=sukses');
        } else {
            header('Location: data_pegawai.php?e=gagal');
        }
        break;
}
?>

