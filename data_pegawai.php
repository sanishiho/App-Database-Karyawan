<?php
include "header.php";
include "koneksi.php"; // Pastikan Anda menghubungkan ke database

$view = isset($_GET['view']) ? $_GET['view'] : null;

switch ($view) {
    default:
    ?>
    <!-- Display messages -->
    <?php
    if (isset($_GET['e']) && $_GET['e'] == 'sukses') {
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
    } elseif (isset($_GET['e']) && $_GET['e'] == 'gagal') {
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
                <h3 class="panel-title">Data Pegawai</h3>
            </div>
            <div class="panel-body">
                <a href="data_pegawai.php?view=tambah" style="margin-bottom: 10px;" class="btn btn-primary">Tambah Data</a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Golongan</th>
                            <th>Status</th>
                            <th>Jumlah Anak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = mysqli_query($konek, "SELECT pegawai.*, jabatan.nama_jabatan, golongan.nama_golongan 
                                                     FROM pegawai 
                                                     INNER JOIN jabatan ON pegawai.kode_jabatan=jabatan.kode_jabatan 
                                                     INNER JOIN golongan ON pegawai.kode_golongan=golongan.kode_golongan 
                                                     ORDER BY pegawai.nama_pegawai ASC");
                        $no = 1;

                        while ($d = mysqli_fetch_array($sql)) {
                            echo "<tr>
                                <td width='40px' align='center'>$no</td>
                                <td>$d[nip]</td>
                                <td>$d[nama_pegawai]</td>
                                <td>$d[nama_jabatan]</td>
                                <td>$d[nama_golongan]</td>
                                <td>$d[status]</td>
                                <td>$d[jumlah_anak]</td>
                                <td width='160px' align='center'>
                                    <a class='btn btn-warning btn-sm' href='data_pegawai.php?view=edit&id=$d[nip]'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href='aksi_pegawai.php?act=del&id=$d[nip]'>Hapus</a>
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
    ?> 

    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Tambah Data Pegawai</h3>           
            </div>
            <div class="panel-body">
                <form method="post" action="aksi_pegawai.php?act=insert">
                    <table>
                        <tr>
                            <td width="160px">NIP</td>
                            <td>
                                <input type="text" name="nip" class="form-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Pegawai</td>
                            <td>
                                <input class="form-control" type="text" name="nama_pegawai" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>
                                <select name="kode_jabatan" class="form-control" required>
                                    <option value="">- Pilih -</option>
                                    <?php 
                                    $sqlJabatan = mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                                    while ($j = mysqli_fetch_array($sqlJabatan)) {
                                        echo "<option value='$j[kode_jabatan]'>$j[kode_jabatan] - $j[nama_jabatan]</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Golongan</td>
                            <td>
                                <select name="kode_golongan" class="form-control" required>
                                    <option value="">- Pilih -</option>
                                    <?php 
                                    $sqlGolongan = mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                                    while ($g = mysqli_fetch_array($sqlGolongan)) {
                                        echo "<option value='$g[kode_golongan]'>$g[kode_golongan] - $g[nama_golongan]</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select name="status" class="form-control" required>
                                    <option value="">- Pilih -</option>
                                    <option value="Menikah">Menikah</option>
                                    <option value="Belum Menikah">Belum Menikah</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah Anak</td>
                            <td>
                                <input class="form-control" type="number" name="jumlah_anak" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input class="btn btn-primary" type="submit" value="Simpan">
                                <a class="btn btn-danger" href="data_pegawai.php">Kembali</a>
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
        // kode untuk tampilan edit
        $sqlEdit = mysqli_query($konek, "SELECT * FROM pegawai WHERE nip='" . $_GET['id'] . "'");
        $e = mysqli_fetch_array($sqlEdit);
    ?>

    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Edit Data Pegawai</h3>
            </div>
            <div class="panel-body">
                <form method="post" action="aksi_pegawai.php?act=update">
                    <table class="table">
                        <tr>
                            <td width="160px">NIP</td>
                            <td>
                                <input type="text" name="nip" value="<?php echo $e['nip']; ?>" class="form-control" readonly>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Pegawai</td>
                            <td>
                                <input class="form-control" type="text" name="nama_pegawai" value="<?php echo $e['nama_pegawai']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>
                                <select name="kode_jabatan" class="form-control" required>
                                    <?php 
                                    $sqlJabatan = mysqli_query($konek, "SELECT * FROM jabatan ORDER BY kode_jabatan ASC");
                                    while ($j = mysqli_fetch_array($sqlJabatan)) {
                                        $selected = ($j['kode_jabatan'] == $e['kode_jabatan']) ? 'selected' : '';
                                        echo "<option value='$j[kode_jabatan]' $selected>$j[kode_jabatan] - $j[nama_jabatan]</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Golongan</td>
                            <td>
                                <select name="kode_golongan" class="form-control" required>
                                    <?php 
                                    $sqlGolongan = mysqli_query($konek, "SELECT * FROM golongan ORDER BY kode_golongan ASC");
                                    while ($g = mysqli_fetch_array($sqlGolongan)) {
                                        $selected = ($g['kode_golongan'] == $e['kode_golongan']) ? 'selected' : '';
                                        echo "<option value='$g[kode_golongan]' $selected>$g[kode_golongan] - $g[nama_golongan]</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                <select name="status" id="status" class="form-control" onchange="autoAnak()" required>
                                    <option value="Menikah" <?php echo ($e['status'] == 'Menikah') ? 'selected' : ''; ?>>Menikah</option>
                                    <option value="Belum Menikah" <?php echo ($e['status'] == 'Belum Menikah') ? 'selected' : ''; ?>>Belum Menikah</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah Anak</td>
                            <td>
                                <input class="form-control" type="number" id="jumlahanak" name="jumlah_anak" value="<?php echo $e['jumlah_anak']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input class="btn btn-primary" type="submit" value="Simpan">
                                <a href="data_pegawai.php" class="btn btn-danger">Kembali</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    function autoAnak() {
        var status = document.getElementById('status').value;
        var jumlahanak = document.getElementById('jumlahanak');
        if (status == 'Belum Menikah') {
            jumlahanak.value = '0';
            jumlahanak.readOnly = true;
        } else {
            jumlahanak.value = '';
            jumlahanak.readOnly = false;
        }
    }
    </script>

    <?php
    break;
}
?>
</div>
<?php include "footer.php"; ?>
