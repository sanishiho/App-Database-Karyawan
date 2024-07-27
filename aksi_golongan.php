<?php 
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit();
}

if (isset($_GET['act'])) {
    // Jika act = insert
    if ($_GET['act'] == 'insert') {
        // Simpan inputan form ke variabel
        $kode = $_POST['kodegolongan'];
        $nama = $_POST['namagolongan'];
        $tunjangansi = $_POST['tunjangansi'];
        $tunjangananak = $_POST['tunjangananak'];
        $uangmakan = $_POST['uangmakan'];
        $uanglembur = $_POST['uanglembur'];

        if ($kode == '' || $nama == '' || $tunjangansi == '' || $tunjangananak == '' || $uangmakan == '' || $uanglembur == '') {
            header('location:data_golongan.php?view=tambah&ebl');
        } else {
            $simpan = mysqli_query($konek, "INSERT INTO golongan (kode_golongan, nama_golongan, tunjangan_suami_istri, tunjangan_anak, uang_makan, uang_lembur) VALUES ('$kode', '$nama', '$tunjangansi', '$tunjangananak', '$uangmakan', '$uanglembur')");
            
            if ($simpan) {
                header('Location: data_golongan.php?e=sukses');
            } else {
                echo "Error: " . mysqli_error($konek);
            }
            exit();
        }
    }

    // Jika act = update
    elseif ($_GET['act'] == 'update') {
        // Simpan inputan form ke variabel
        $kode = $_POST['kodegolongan'];
        $nama = $_POST['namagolongan'];
        $tunjangansi = $_POST['tunjangansi'];
        $tunjangananak = $_POST['tunjangananak'];
        $uangmakan = $_POST['uangmakan'];
        $uanglembur = $_POST['uanglembur'];

        if ($kode == '' || $nama == '' || $tunjangansi == '' || $tunjangananak == '' || $uangmakan == '' || $uanglembur == '') {
            header('location:data_golongan.php?view=edit&id=' . $kode . '&ebl');
        } else {
            $update = mysqli_query($konek, "UPDATE golongan SET nama_golongan='$nama', tunjangan_suami_istri='$tunjangansi', tunjangan_anak='$tunjangananak', uang_makan='$uangmakan', uang_lembur='$uanglembur' WHERE kode_golongan='$kode'");
            if ($update) {
                header('Location: data_golongan.php?e=sukses');
            } else {
                echo "Error: " . mysqli_error($konek);
            }
            exit();
        }
    }

    // Jika act = del
    elseif ($_GET['act'] == 'del') {
        $hapus = mysqli_query($konek, "DELETE FROM golongan WHERE kode_golongan='" . $_GET['id'] . "'");
        if ($hapus) {
            header('Location:data_golongan.php?e=sukses');
        } else {
            echo "Error: " . mysqli_error($konek);
        }
        exit();
    }
}
?>
