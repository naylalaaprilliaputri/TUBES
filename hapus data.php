<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    mysqli_query(
        $koneksi,
        "DELETE FROM lapangan WHERE id_lapangan = '$id'"
    );
}

header("Location: lapangan olahraga.php");
exit;
?>