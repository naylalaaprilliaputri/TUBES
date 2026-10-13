<?php
include "koneksi.php";

$id = $_GET["id"];

if (isset($_POST["simpan"])) {
    $nama = $_POST["nama_lapangan"];
    $jenis = $_POST["jenis_lantai"];
    $ukuran = $_POST["ukuran"];
    $status = $_POST["status_fisik"];
    $tarif = $_POST["tarif"];

    $query = "UPDATE lapangan SET
              nama_lapangan='$nama',
              jenis_lantai='$jenis',
              ukuran='$ukuran',
              status_fisik='$status',
              tarif='$tarif'
              WHERE id_lapangan='$id'";

    mysqli_query($koneksi, $query);

    header("Location: lapangan olahraga.php");
    exit;
}

$query = mysqli_query($koneksi, "SELECT * FROM lapangan WHERE id_lapangan='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lapangan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <h1>Edit Lapangan</h1>
        <p class="intro">Perbarui informasi lapangan yang ingin diubah.</p>

        <h2>Form Edit Lapangan</h2>
        <form method="POST" class="form-grid">
            <div>
                <label>ID Lapangan</label>
                <input type="text" value="<?= $data["id_lapangan"] ?>" disabled>
            </div>
            <div>
                <label>Nama Lapangan</label>
                <input type="text" name="nama_lapangan" value="<?= $data["nama_lapangan"] ?>" required>
            </div>
            <div>
                <label>Jenis Rumput / Lantai</label>
                <select name="jenis_lantai">
                    <?php
                    $jenis_lantai = ["Rumput", "Matras", "Vinyl", "Karet", "Parket Kayu"];
                    foreach ($jenis_lantai as $jenis) {
                        $pilihan = ($data["jenis_lantai"] == $jenis) ? "selected" : "";
                        echo "<option $pilihan>$jenis</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label>Ukuran (Panjang x Lebar)</label>
                <input type="text" name="ukuran" value="<?= $data["ukuran"] ?>" required>
            </div>
            <div>
                <label>Status Fisik</label>
                <select name="status_fisik">
                    <?php
                    $status_lapangan = ["Baik", "Rusak", "Maintenance"];
                    foreach ($status_lapangan as $status) {
                        $pilihan = ($data["status_fisik"] == $status) ? "selected" : "";
                        echo "<option $pilihan>$status</option>";
                    }
                    ?>
                </select>
            </div>
            <div>
                <label>Tarif Sewa / Jam (Rp)</label>
                <input type="number" name="tarif" value="<?= $data["tarif"] ?>" min="0" required>
            </div>
            <div class="form-actions">
                <button type="submit" name="simpan" class="btn-primary">Simpan Perubahan</button>
                <a href="lapangan olahraga.php" class="btn-secondary">Kembali</a>
            </div>
        </form>
    </main>
</body>
</html>