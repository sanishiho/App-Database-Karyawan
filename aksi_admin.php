 <?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit();
}

//jika ada get act
if (isset($_GET['act'])) {
    //jika act = insert
    if ($_GET['act'] == 'insert') {
        //simpan inputan form ke variabel
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $namalengkap = $_POST['namalengkap'];
        
        //apabila form belum lengkap
        if ($username == '' || $_POST['password'] == '' || $namalengkap == '') {
            echo "Form anda Belum lengkap...!";
        } else {
            //proses simpan data
            $simpan = mysqli_query($konek, "INSERT INTO admin(username, password, namalengkap) VALUES ('$username', '$password', '$namalengkap')");
            if ($simpan) {
                header('Location: data_admin.php?e=sukses');
            } else {
                header('Location: data_admin.php?e=gagal');
            }
            exit();
        }
    } elseif ($_GET['act'] == 'update') {
        $idadmin = $_POST['idadmin'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $namalengkap = $_POST['namalengkap'];

        //apabila form belum lengkap
        if ($username == '' || $namalengkap == '') {
            echo "Form anda Belum lengkap...!";
        } else {
            if ($password == '') {
                $update = mysqli_query($konek, "UPDATE admin SET username='$username', namalengkap='$namalengkap' WHERE idadmin='$idadmin'");
            } else {
                $password = md5($password);
                $update = mysqli_query($konek, "UPDATE admin SET username='$username', password='$password', namalengkap='$namalengkap' WHERE idadmin='$idadmin'");
            }
            if ($update) {
                header('Location: data_admin.php?e=sukses');
            } else {
                header('Location: data_admin.php?e=gagal');
            }
            exit();
        }
    } elseif ($_GET['act'] == 'delete') {
        $idadmin = $_GET['id'];
        $hapus = mysqli_query($konek, "DELETE FROM admin WHERE idadmin='$idadmin' AND idadmin!='1'");
        
        if ($hapus) {
            header('Location: data_admin.php?e=sukses');
        } else {
            header('Location: data_admin.php?e=gagal');
        }
        exit();
    } else {
        header('Location: data_admin.php');
        exit();
    }
} else { //jika tidak ada get act
    header('Location: data_admin.php');
    exit();
}
?>



 			
 		
 	
 