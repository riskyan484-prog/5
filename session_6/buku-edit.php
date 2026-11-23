<?php
require_once 'koneksi.php';

$id = $_GET['id'];

// Mengambil data buku
$sql = "SELECT * FROM tb_buku WHERE id_buku = '$id'";
$query = mysqli_query($conn, $sql);

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data buku tidak ditemukan!";
    exit;
}

// Mengambil data kategori buku
$sql_kategori_buku = "SELECT * FROM tb_kategori_buku ORDER BY kategori_buku ASC";
$query_kategori_buku = mysqli_query($conn, $sql_kategori_buku);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
</head>
<body>

    <h2>Edit Buku</h2>

    <form method="POST" action="buku-update.php" enctype="multipart/form-data">

        <input type="hidden" name="id_buku" value="<?= $data['id_buku']; ?>">

        <label>Kategori Buku</label>
        <br>
        <select name="id_kategori_buku" required>

            <?php while ($kategori_buku = mysqli_fetch_assoc($query_kategori_buku)) { ?>
                <option value="<?= $kategori_buku['id_kategori_buku']; ?>"
                    <?= ($kategori_buku['id_kategori_buku'] == $data['id_kategori_buku']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($kategori_buku['kategori_buku']); ?>
                </option>
            <?php } ?>

        </select>

        <br><br>

        <label>Judul Buku</label>
        <br>
        <input type="text" name="judul_buku"
               value="<?= htmlspecialchars($data['judul_buku']); ?>" required>

        <br><br>

        <label>Penulis</label>
        <br>
        <input type="text" name="penulis"
               value="<?= htmlspecialchars($data['penulis']); ?>" required>

        <br><br>

        <label>Penerbit</label>
        <br>
        <input type="text" name="penerbit"
               value="<?= htmlspecialchars($data['penerbit']); ?>" required>

        <br><br>

        <label>Foto Buku Saat Ini</label>
        <br>

        <?php if (!empty($data['foto_buku'])) { ?>
            <img src="cover/<?= htmlspecialchars($data['foto_buku']); ?>" width="150">
        <?php } else { ?>
            Tidak ada foto.
        <?php } ?>

        <br><br>

        <label>Ganti Foto Buku</label>
        <br>
        <input type="file" name="foto_buku" accept="image/*">

        <br><br>

        <button type="submit" name="update">Update</button>
        <a href="buku.php">Kembali</a>

    </form>

</body>
</html>