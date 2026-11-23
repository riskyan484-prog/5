<?php
require_once 'koneksi.php';

$kategori = $_POST['kategori'];

$sql = "INSERT INTO tb_kategori_buku (kategori_buku)
        VALUES ('$kategori')";

$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('Kategori buku berhasil ditambahkan!');
            window.location='kategori-buku.php';
          </script>";
} else {
    echo "<script>
            alert('Kategori buku gagal ditambahkan!');
            window.location='kategori-buku.php';
          </script>";
}
?>