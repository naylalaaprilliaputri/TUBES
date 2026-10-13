<?php
include "koneksi.php";

if (isset($_POST["tambah"])) {
    $id = $_POST["id_lapangan"];
    $nama = $_POST["nama_lapangan"];
    $jenis = $_POST["jenis_lantai"];
    $ukuran = $_POST["ukuran"];
    $status = $_POST["status_fisik"];
    $tarif = $_POST["tarif"];

    $query = "INSERT INTO lapangan VALUES ('$id', '$nama', '$jenis', '$ukuran', '$status', '$tarif')";
    mysqli_query($koneksi, $query);

    header("Location: lapangan olahraga.php");
    exit;
}

$data_lapangan = mysqli_query($koneksi, "SELECT * FROM lapangan");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Lapangan Olahraga</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="container">
        <h1>Pendataan Lapangan Olahraga</h1>
        <p class="intro">Informasi terkait data semua area dan lapangan olahraga: jenis rumput/lantai, ukuran, dan status fisik.</p>

        <h2>Form Tambah Lapangan</h2>
        <form method="POST" class="form-grid">
            <div>
                <label>ID Lapangan</label>
                <input type="text" name="id_lapangan" placeholder="Contoh: LF01" required>
            </div>
            
            <div>
                <label>Nama Lapangan</label>
                <input type="text" name="nama_lapangan" placeholder="Contoh: Lapangan Futsal" required>
            </div>

            <div>
                <label>Jenis Rumput / Lantai</label>
                <select name="jenis_lantai">
                    <option>Rumput</option>
                    <option>Matras</option>
                    <option>Vinyl</option>
                    <option>Karet</option>
                    <option>Parket Kayu</option>
                </select>
            </div>

            <div>
                <label>Ukuran (Panjang x Lebar)</label>
                <input type="text"  name="ukuran" placeholder="Contoh: 20m x 15m" required>
            </div>
            
            <div>
                <label>Status Fisik</label>
                <select name="status_fisik">
                    <option>Baik</option>
                    <option>Rusak</option>
                    <option>Maintenance</option>
                </select>
            </div>

            <div>
                <label>Tarif Sewa / Jam</label>
                <input type="number" name="tarif" placeholder="Contoh: 100000" min="0" required>
            </div>

            <div class="form-actions">
                <button type="submit" name="tambah" class="btn-primary">Simpan Lapangan</button>
                <button type="reset" class="btn-secondary">Reset</button>
            </div>
        </form>

        <h2>Daftar Lapangan & Area</h2>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>ID Lapangan</th>
                    <th>Nama Lapangan</th>
                    <th>Jenis Lantai/Rumput</th>
                    <th>Ukuran</th>
                    <th>Tarif/Jam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                </thead>

                <tbody>
                    <?php $nomor = 1; ?>
                    <?php while ($lapangan = mysqli_fetch_assoc($data_lapangan)) { ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $lapangan["id_lapangan"] ?></td>
                        <td><?= $lapangan["nama_lapangan"] ?></td>
                        <td><?= $lapangan["jenis_lantai"] ?></td>
                        <td><?= $lapangan["ukuran"] ?></td>
                        <td>Rp <?= number_format($lapangan["tarif"], 0, ",", ".") ?></td>
                        <td><?= $lapangan["status_fisik"] ?></td>
                        <td class="actions">
                            <a href="edit lapangan.php?id=<?php echo urlencode($lapangan['id_lapangan']); ?>">Edit</a>
                            <a href="hapus data.php?id=<?php echo urlencode($lapangan['id_lapangan']); ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                
            </table>
        </div>
    </main> 
</body>
</html>

