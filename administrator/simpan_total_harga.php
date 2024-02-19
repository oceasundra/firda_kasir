<?php
//koneksi database
include '../koneksi.php';

//menangkap data yang dikirim
$total_harga = $_POST['total_harga'];
$id_penjualan = $_POST['id_penjualan'];
$id_pelanggan = $_POST['id_pelanggan'];

//menginput data
mysqli_query($koneksi,"update penjualan set total_harga='$total_harga' where id_penjualan='$id_penjualan'");

//mengalihkan
header("location:detail_pembelian.php?id_pelanggan=$id_pelanggan");

?>