<?php include "header.php"; ?>
<div class="container">

<?php
$view = isset($_GET['view']) ? $_GET['view'] : null;

switch($view){
    default:
    ?>
    <!--menampilkan pesan -->
    <?php
    if(isset($_GET['e']) && $_GET['e'] == 'sukses') {
    ?>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Selamat!</strong> Proses Berhasil
                </div>
            </div>
        </div>
    <?php
    } elseif(isset($_GET['e']) && $_GET['e'] == 'gagal') {
    ?>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Proses gagal dilakukan.
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Data Jabatan</h3>
            </div>
            <div class="panel-body">
                <a href="data_jabatan.php?view=tambah" style="margin-bottom: 10px;" class="btn btn-primary">Tambah Data</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Jabatan</th>
                            <th>Nama Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                        $no = 1;
                        while($d = mysqli_fetch_array($sql)){
                            echo "<tr>
                                <td width='40px' align='center'>$no</td>
                                <td>$d[kode_jabatan]</td>
                                <td>$d[nama_jabatan]</td>
                                <td>$d[gaji_pokok]</td>
                                <td>$d[tunjangan_jabatan]</td>
                                <td width='160px' align='center'>
                                    <a class='btn btn-warning btn-sm' href='data_jabatan.php?view=edit&id=$d[kode_jabatan]'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href='aksi_jabatan.php?act=del&id=$d[kode_jabatan]'>Hapus</a>
                                </td>
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div> 
    </div>
    <?php 
    break;

    case "tambah":
        //kode untuk tampilan tambah
        $simbol = "JO";
        $query = mysqli_query($konek, "SELECT MAX(kode_jabatan) AS last FROM jabatan WHERE kode_jabatan LIKE '$simbol%'");
        $data = mysqli_fetch_array($query);

        if ($data['last']) {
            $kodeterakhir = $data['last'];
            $nomorterakhir = substr($kodeterakhir, 2); // Extract the numeric part after "JO"
            $nextNomor = (int)$nomorterakhir + 1;
            $nextKode = $simbol . sprintf('%02d', $nextNomor);
        } else {
            $nextKode = $simbol . '01';
        }
    ?>
    <?php
    if(isset($_GET['e']) && $_GET['e'] == 'sukses') {
    ?>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Peringatan</strong> Form Anda belum lengkap, silahkan dilengkapi.
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Tambah Data Jabatan</h3>           
            </div>
            <div class="panel-body">
                <form method="post" action="aksi_jabatan.php?act=insert">
                    <table>
                        <tr>
                            <td width="160px">Kode Jabatan</td>
                            <td>
                                <input type="text" name="kodejabatan" value="<?php echo $nextKode; ?>" class="form-control" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Jabatan</td>
                            <td>
                                <input class="form-control" type="text" name="namajabatan" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Gaji Pokok</td>
                            <td>
                                <input class="form-control" type="number" name="gajipokok" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Tunjangan Jabatan</td>
                            <td>
                                <input class="form-control" type="number" name="tunjanganjabatan" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input class="btn btn-primary" type="submit" value="Simpan">
                                <a class="btn btn-danger" href="data_jabatan.php">Kembali</a>
                            </td>
                        </tr>
                    </table> 
                </form>
            </div>
        </div>
    </div>

    <?php
    break;

    case "edit":
        //kode untuk tampilan edit
        $sqlEdit = mysqli_query($konek, "SELECT * FROM jabatan WHERE kode_jabatan='" . $_GET['id'] . "'");
        $e = mysqli_fetch_array($sqlEdit);
    ?>

    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Data Jabatan</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="aksi_jabatan.php?act=update">
                    <table class="table">
                        <tr>
                            <td width="160px">Kode Jabatan</td>
                            <td>
                                <input type="text" name="kodejabatan" value="<?php echo $e['kode_jabatan']; ?>" class="form-control" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Jabatan</td>
                            <td>
                                <input class="form-control" type="text" name="namajabatan" value="<?php echo $e['nama_jabatan']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Gaji Pokok</td>
                            <td>
                                <input class="form-control" type="number" name="gajipokok" value="<?php echo $e['gaji_pokok']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Tunjangan Jabatan</td>
                            <td>
                                <input class="form-control" type="number" name="tunjanganjabatan" value="<?php echo $e['tunjangan_jabatan']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input class="btn btn-primary" type="submit" value="Simpan">
                                <a href="data_jabatan.php" class="btn btn-danger">Kembali</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <?php
    break;
}
?>
</div>
<?php include "footer.php"; ?>
