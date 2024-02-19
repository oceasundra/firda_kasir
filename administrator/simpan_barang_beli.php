<?php
//koneksi database
include '../koneksi.php';

//menangkap data yang dikirim
$id_produk = $_POST['id_produk'];
$id_detailpenjualan = $_POST['id_detailpenjualan'];
$id_pelanggan = $_POST['id_pelanggan'];


//menginput data
mysqli_query($koneksi,"update detailpenjualan set id_produk='$id_produk' where id_detailpenjualan='$id_detailpenjualan'");

//mengalihkan
header("location:detail_pembelian.php?id_pelanggan=$id_pelanggan");

?>