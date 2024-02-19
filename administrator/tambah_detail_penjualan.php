<?php
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$id_pelanggan = $_POST['id_pelanggan'];
$id_penjualan = $_POST['id_penjualan'];

// menginput data ke database
mysqli_query($koneksi, "INSERT INTO detailpenjualan (id_penjualan, id_produk) VALUES ('$id_penjualan', NULL)");

// mengalihkan halaman kembali ke detail_pembelian.php
header("location:detail_pembelian.php?id_pelanggan=$id_pelanggan");
?>