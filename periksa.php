<?php
include_once("koneksi.php");
?>

<?php
if (isset($_POST['simpan'])) {

    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $tgl_periksa = $_POST['tgl_periksa'];
    $catatan = $_POST['catatan'];

    if (!isset($_GET['id_periksa'])) {
        $query = "INSERT INTO periksa (id_pasien, id_dokter, tgl_periksa, catatan) VALUES ('$id_pasien', '$id_dokter', '$tgl_periksa', '$catatan')";
    } else {
        $query = "UPDATE `periksa` SET `id_pasien` = '$id_pasien', `id_dokter` = '$id_dokter', `tgl_periksa` = '$tgl_periksa', `catatan` = '$catatan' WHERE id_periksa='" . $_GET['id_periksa'] . "'";
    }
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        header("Location: index.php?page=periksa");
        exit;
    } else {
        echo "Terjadi kesalahan saat menambahkan data periksa: " . mysqli_error($mysqli);
    }
}

if (isset($_GET['aksi'])) {
    $query = "DELETE FROM `periksa` WHERE id_periksa='" . $_GET['id_periksa'] . "'";
    $result = mysqli_query($mysqli, $query);
    header("index.php?page=periksa");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periksa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous"> 
</head>
<body>
<div class="container">
<hr>    

<form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
    <?php
    $id_pasien = '';
    $nama_dokter = '';
    $tgl_periksa = '';
    $catatan = '';
    
    if (isset($_GET['id_periksa'])) {
        $ambil = mysqli_query($mysqli, "SELECT * FROM periksa 
        WHERE periksa.id_periksa='" . $_GET['id_periksa'] . "'");
        
        while ($row = mysqli_fetch_array($ambil)) {
            $id_pasien = $row['id_pasien'];
            $id_dokter = $row['id_dokter'];
            $tgl_periksa = $row['tgl_periksa'];
            $catatan = $row['catatan'];
        }
    ?>
    <input type="hidden" name="id" value="<?php echo $_GET['id_periksa'] ?>">
    <?php
    }
    ?>

    <div class="form-group mx-sm-3 mb-2">
        <label for="inputPasien" class="sr-only">Pasien</label>
        <select class="form-control" name="id_pasien">
            <?php
            $selected = '';
            $pasien = mysqli_query($mysqli, "SELECT * FROM pasien");
            while ($data = mysqli_fetch_array($pasien)) {
                if ($data['id_pasien'] == $id_pasien) {
                    $selected = 'selected="selected"';
                } else {
                    $selected = '';
                }
            ?>
                <option value="<?php echo $data['id_pasien'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>

    <div class="form-group mx-sm-3 mb-2">
        <label for="inputDokter" class="sr-only">Dokter</label>
        <select class="form-control" name="id_dokter">
            <?php
            $selected = '';
            $dokter = mysqli_query($mysqli, "SELECT * FROM dokter");
            while ($data = mysqli_fetch_array($dokter)) {
                if ($data['id_dokter'] == $id_dokter) {
                    $selected = 'selected="selected"';
                } else {
                    $selected = '';
                }
            ?>
                <option value="<?php echo $data['id_dokter'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    
    <div class="form-group mx-sm-3 mb-2">
        <label for="inputTanggal" class="form-label fw-bold">
            Tanggal Periksa
        </label>
        <input type="datetime-local" class="form-control" name="tgl_periksa" id="inputTanggal" value="<?php echo $tgl_periksa; ?>">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="inputCatatan" class="form-label fw-bold">
            Catatan
        </label>
        <textarea class="form-control" name="catatan" id="inputCatatan" placeholder="Catatan"><?php echo $catatan; ?></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
    </div>

</form>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Pasien</th>
            <th scope="col">Dokter</th>
            <th scope="col">Tanggal Periksa</th>
            <th scope="col">Catatan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    
    <tbody>
        <?php
        $result = mysqli_query(
            $mysqli, "SELECT pr.*, d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter = d.id_dokter) LEFT JOIN pasien p ON (pr.id_pasien = p.id_pasien) ORDER BY pr.tgl_periksa DESC"
        );
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <th scope="row"><?php echo $no++ ?></th>
                <td><?php echo $data['nama_pasien'] ?></td>
                <td><?php echo $data['nama_dokter'] ?></td>
                <td><?php echo $data['tgl_periksa'] ?></td>
                <td><?php echo $data['catatan'] ?></td>
                <td>
                    <a class="btn btn-success rounded-pill px-3" href="index.php?page=periksa&id_periksa=<?php echo $data['id_periksa'] ?>">Ubah</a>
                    <a class="btn btn-danger rounded-pill px-3" href="index.php?page=periksa&id_periksa=<?php echo $data['id_periksa'] ?>&aksi=hapus">Hapus</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</div>
</body>
</html>
