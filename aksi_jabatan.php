<?php 
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header('location:login.php');
}

if (isset($_GET['act'])) {
    // Jika act = insert
    if ($_GET['act'] == 'insert') {
        // Simpan inputan form ke variabel
        $kode = $_POST['kodejabatan'];
        $nama = $_POST['namajabatan'];
        $gajipokok = $_POST['gajipokok'];
        $tunjangan = $_POST['tunjanganjabatan'];

        if($kode == '' || $nama == '' || $gajipokok == '' || $tunjangan == ''){
            header('location:data_jabatan.php?view=tambah&ebl');
        } else {
            $simpan = mysqli_query($konek, "INSERT INTO jabatan (kode_jabatan, nama_jabatan, gaji_pokok, tunjangan_jabatan) VALUES ('$kode', '$nama', '$gajipokok', '$tunjangan')");
            if ($simpan) {
                header('Location: data_jabatan.php?e=sukses');
            } else {
                header('Location: data_jabatan.php?e=gagal');
            }
            exit();
        }
    }

    // Jika act = update
    elseif ($_GET['act'] == 'update') {
        // Simpan inputan form ke variabel
        $kode = $_POST['kodejabatan'];
        $nama = $_POST['namajabatan'];
        $gajipokok = $_POST['gajipokok'];
        $tunjangan = $_POST['tunjanganjabatan'];

        if($kode == '' || $nama == '' || $gajipokok == '' || $tunjangan == ''){
            header('location:data_jabatan.php?view=tambah&ebl');
        } else {
            $update = mysqli_query($konek, "UPDATE jabatan SET nama_jabatan='$nama', gaji_pokok='$gajipokok', tunjangan_jabatan='$tunjangan' WHERE kode_jabatan='$kode'");
            if ($update) {
                header('Location: data_jabatan.php?e=sukses');
            } else {
                header('Location: data_jabatan.php?e=gagal');
            }
            exit();
        }
    }

    // Jika act = del
    elseif ($_GET['act'] == 'del') {
        $hapus = mysqli_query($konek, "DELETE FROM jabatan WHERE kode_jabatan='".$_GET['id']."'");
        if ($hapus) {
            header('Location:data_jabatan.php?e=sukses');
        } else {
            header('Location:data_jabatan.php?e=gagal');
        }
        exit();
    }
}
?>
