<?php
include_once("koneksi.php");

?>
<?php

if (isset($_POST['simpan'])) {

    $id_periksa = $_POST['id_periksa'];
    $id_obat = $_POST['id_obat'];

    if (isset($_GET['id'])) {
        $query = "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ('$id_periksa', '$id_obat)";
    } else {
        $query = "UPDATE `detail_periksa` SET `id_periksa` = '$id_periksa', `id_obat` = '$id_obat' WHERE id='" . $_GET['id'] . "'";
    }
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        header("Location: index.php?page=detail_periksa");
        exit;
    } else {
        echo "Terjadi kesalahan saat menambahkan data detail periksa:" . mysqli_error($mysqli);
    }
}

if (isset($_GET['aksi'])) {
    $query = "DELETE FROM `detail_periksa` WHERE id='" . $_GET['id'] . "'";
    $result = mysqli_query($mysqli, $query);
    header("Location: index.php?page=detail_periksa");
}
?>
<div class="container">
    <!--Form Input Data-->

    <form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
        <!-- Kode php untuk menghubungkan form dengan database -->
        <?php
        $id_periksa = '';
        $id_obat = '';
        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, "SELECT * FROM detail_periksa
                    WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $id_periksa = $row['id_periksa'];
                $id_obat = $row['id_obat'];
            }
        ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <?php
        }
        ?>
        <div class="col">
        <label for="inputBiaya_periksa" class="form-label fw-bold">
            Biaya Periksa
        </label>
        <select class="form-control" name="id_periksa" id="inputBiaya_periksa">
        <?php
        $selected = '';
        $periksa = mysqli_query($mysqli, "SELECT * FROM Periksa");
        while ($data = mysqli_fetch_array($periksa)) {
            if ($data['id_periksa'] == $id_periksa) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        ?>
            <option value="<?php echo $data['id_periksa'] ?>" <?php echo $selected ?>><?php echo $data['biaya_periksa'] ?></option>
        <?php
        }
        ?>
    </select>
    </div>
    <div class="col">
        <label for="inputHarga_obat" class="form-label fw-bold">
        Harga Obat
        </label>
        <select class="form-control" name="id_obat" id="inputHarga_obat">
        <?php
        $selected = '';
        $obat = mysqli_query($mysqli, "SELECT * FROM obat");
        while ($data = mysqli_fetch_array($obat)) {
            if ($data['id'] == $id_obat) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        ?>
            <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['harga'] ?></option>
        <?php
        }
        ?>
    </select>
    </div>
    <div class="col">
        <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
    </div>
    </form>
    <br>
    <br>
    <!-- Table-->
    <table class="table table-hover">
        <!--thead atau baris judul-->
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Biaya Periksa</th>
                <th scope="col">Harga Obat</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <!--tbody berisi isi tabel sesuai dengan judul atau head-->
        <tbody>
            <!-- Kode PHP untuk menampilkan semua isi dari tabel urut-->
            <?php
            $result = mysqli_query($mysqli, "SELECT detail_periksa.*,periksa.biaya_periksa as 'biaya_periksa', obat.harga as 'harga' FROM detail_periksa LEFT JOIN periksa ON (detail_periksa.id_periksa=periksa.id_periksa) LEFT JOIN obat ON (detail_periksa.id_obat=obat.id) ORDER BY id ASC");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
                $total_biaya = $data['biaya_periksa'] + $data['harga'];
            ?>
                <tr>
                    <th scope="row"><?php echo $no++ ?></th>
                    <td><?php echo $data['biaya_periksa'] ?></td>
                    <td><?php echo $data['harga'] ?></td>
                    <td><?php echo $total_biaya ?></td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="index.php?page=detail_periksa&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="index.php?page=detail_periksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>