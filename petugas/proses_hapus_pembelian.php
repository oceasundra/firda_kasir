<?php
include '../koneksi.php';

$id_pelanggan = $_POST['id_pelanggan'];

mysqli_query($koneksi,"DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
mysqli_query($koneksi,"DELETE FROM penjualan WHERE id_pelanggan='$id_pelanggan'");

header("location:pembelian.php?pesan=hapus");
?>