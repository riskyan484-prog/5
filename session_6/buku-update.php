<?php
require_once 'koneksi.php';

$id_buku = $_POST['id_buku'];
$id_kategori_buku = $_POST['id_kategori_buku'];
$judul_buku = mysqli_real_escape_string($conn, $_POST['judul_buku']);
$penulis = mysqli_real_escape_string($conn, $_POST['penulis']);
$penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);

$sql_foto = "SELECT foto_buku FROM tb_buku WHERE id_buku = '$id_buku'";
$query_foto = mysqli_query($conn, $sql_foto);
$data_foto = mysqli_fetch_assoc($query_foto);

$foto_buku = $data_foto['foto_buku'];

if (!empty($_FILES['foto_buku']['name'])) {

    $foto_buku = $_FILES['foto_buku']['name'];
    $tmp = $_FILES['foto_buku']['tmp_name'];

    $folder = "cover/";

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    move_uploaded_file($tmp, $folder . $foto_buku);

    if (!empty($data_foto['foto_buku']) && file_exists($folder . $data_foto['foto_buku'])) {
        unlink($folder . $data_foto['foto_buku']);
    }
}


$sql = "UPDATE tb_buku SET
        id_kategori_buku = '$id_kategori_buku',
        judul_buku = '$judul_buku',
        penulis = '$penulis',
        penerbit = '$penerbit',
        foto_buku = '$foto_buku'
        WHERE id_buku = '$id_buku'";

$query = mysqli_query($conn, $sql);

if ($query) {
    echo "<script>
            alert('Buku berhasil diperbarui!');
            window.location='buku.php';
        </script>";
} else {
    echo "<script>
            alert('Buku gagal diperbarui!');
            window.location='buku.php';
        </script>";
}
?>