<?php
include '../koneksi.php';

$id_produk = $_POST['id_produk'];

mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id_produk'");

header("location:data_barang.php?pesan=hapus");
?>