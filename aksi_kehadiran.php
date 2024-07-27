<?php
include "koneksi.php"; // Pastikan Anda menghubungkan ke database

$act = $_GET['act'];

switch ($act) {
    case 'insert':
        $bulan = $_POST['bulan'];
        $nip = $_POST['nip'];
        $masuk = $_POST['masuk'];
        $sakit = $_POST['sakit'];
        $izin = $_POST['izin'];
        $alpha = $_POST['alpha'];
        $lembur = $_POST['lembur'];
        $potongan = $_POST['potongan'];

        $count = count($nip);

        $sql = "INSERT INTO master_gaji (bulan, nip, masuk, sakit, izin, alpha, lembur, potongan) VALUES ";
        $values = [];

        for($i = 0; $i < $count; $i++){
            $values[] = "('$bulan[$i]', '$nip[$i]', '$masuk[$i]', '$sakit[$i]', '$izin[$i]', '$alpha[$i]', '$lembur[$i]', '$potongan[$i]')";
        }

        $sql .= implode(", ", $values);
        
        if (mysqli_query($konek, $sql)) {
            header('Location: data_kehadiran.php?e=sukses');
        } else {
            header('Location: data_kehadiran.php?e=gagal');
        }
        break;

    case 'update':
        // Tambahkan logika untuk mengupdate data kehadiran pegawai jika ada
        break;

    case 'del':
        $hapus = mysqli_query($konek, "DELETE FROM pegawai WHERE nip='$_GET[id]'");

        if ($hapus) {
            header('Location: data_kehadiran.php?e=sukses');
        } else {
            header('Location: data_kehadiran.php?e=gagal');
        }
        break;
}
?>


