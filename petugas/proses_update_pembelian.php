<?php
include '../koneksi.php';

$id_pelanggan = $_POST['id_pelanggan'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$no_tlp = $_POST['no_tlp'];
$alamat = $_POST['alamat'];

mysqli_query($koneksi,"UPDATE pelanggan SET nama_pelanggan='$nama_pelanggan', no_tlp='$no_tlp', alamat='$alamat' WHERE id_pelanggan='$id_pelanggan'");

header("location:pembelian.php?pesan=update");
?>