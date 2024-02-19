<?php
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari url
$id_detailpenjualan = $_POST['id_detailpenjualan'];
$id_pelanggan = $_POST['id_pelanggan'];

// menghapus data dari database
mysqli_query($koneksi,"delete from detailpenjualan where id_detailpenjualan='$id_detailpenjualan'");

// mengalihkan halaman kembali ke data_barang.php
header("location:detail_pembelian.php?id_pelanggan=$id_pelanggan");

?>