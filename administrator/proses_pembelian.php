<?php
include '../koneksi.php';

$id_pelanggan = $_POST['id_pelanggan'];
$nama_pelanggan = $_POST['nama_pelanggan'];
$no_tlp = $_POST['no_tlp'];
$alamat = $_POST['alamat'];
$tanggal_penjualan = $_POST['tanggal_penjualan'];

mysqli_query($koneksi,"INSERT INTO pelanggan values('$id_pelanggan','$nama_pelanggan', '$alamat','$no_tlp')");
mysqli_query($koneksi,"INSERT INTO penjualan values('','$tanggal_penjualan','','$id_pelanggan')");

header("location:pembelian.php?pesan=simpan");
?>