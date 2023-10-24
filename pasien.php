<?php
include_once("koneksi.php");
?>

<?php
if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];

    if (!isset($_GET['id_pasien'])) {
        $query = "INSERT INTO pasien (nama, alamat, no_hp) VALUES ('$nama', '$alamat', '$no_hp')";
    } else {
        $query = "UPDATE `pasien` SET `nama` = '$nama', `alamat` = '$alamat', `no_hp` = '$no_hp' WHERE id_pasien='" . $_GET['id_pasien'] . "'";
    }
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        header("Location: index.php?page=pasien");
        exit;
    } else {
        echo "Terjadi kesalahan saat menambahkan data pasien: " . mysqli_error($mysqli);
    }
}

if (isset($_GET['aksi'])) {
    $query = "DELETE FROM `pasien` WHERE id_pasien='" . $_GET['id_pasien'] . "'";
    $result = mysqli_query($mysqli, $query);
    header("Location: index.php?page=pasien");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasien</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">   
</head>
<body>
<form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
    <!-- Kode php untuk menghubungkan form dengan database -->
    <?php
$nama = '';
$alamat = '';
$no_hp = '';
if (isset($_GET['id_pasien'])) {
    $ambil = mysqli_query($mysqli, "SELECT * FROM pasien WHERE id_pasien='" . $_GET['id_pasien'] . "'");
if ($ambil) {
    while ($row = mysqli_fetch_array($ambil)) {
        $nama = $row['nama'];
        $alamat = $row['alamat'];
        $no_hp = $row['no_hp'];
    }
} else {
    echo "Kueri gagal: " . mysqli_error($mysqli);
}
?>
    <input type="hidden" name="id" value="<?php echo $_GET['id_pasien'] ?>">
<?php
}
?>
        <input type="hidden" name="id" value="<?php echo
        $_GET['id_pasien'] ?>">
    <?php
    
    ?>
    <div class="col">
        <label for="inputNama" class="form-label fw-bold">
            Nama Pasien
        </label>
        <input type="text" class="form-control" name="nama" id="inputNama" placeholder="Nama Pasien" value="<?php echo $nama ?>">
    </div>
    <div class="col">
        <label for="inputAlamat" class="form-label fw-bold">
            Alamat
        </label>
        <input type="text" class="form-control" name="alamat" id="inputAlamat" placeholder="Alamat" value="<?php echo $alamat ?>">
    </div>
    <div class="col mb-2">
        <label for="inputNoHP" class="form-label fw-bold">
        No HP
        </label>
        <input type="text" class="form-control" name="no_hp" id="inputNoHP" placeholder="No HP" value="<?php echo $no_hp ?>">
    </div>
    <div class="col">
        <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
    </div>
</form>

<!-- Table-->
<table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">Alamat</th>
            <th scope="col">No HP</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
        <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
        berdasarkan status dan tanggal awal-->
        <?php
$result = mysqli_query($mysqli, "SELECT * FROM pasien");
$no = 1;
while ($data = mysqli_fetch_array($result)) {
?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $data['nama'] ?></td>
        <td><?php echo $data['alamat'] ?></td>
        <td><?php echo $data['no_hp'] ?></td>
        <td>
            <a class="btn btn-success rounded-pill px-3" href="index.php?page=pasien&id_pasien=<?php echo $data['id_pasien'] ?>">Ubah</a>
            <a class="btn btn-danger rounded-pill px-3" href="index.php?page=pasien&id_pasien=<?php echo $data['id_pasien'] ?>&aksi=hapus">Hapus</a>
        </td>
    </tr>
<?php
}
?>
    </tbody>
</table>


</body>
</html>