<?php
//koneksi database
include '../koneksi.php';

//menangkap data yang dikirim
$stok = $_POST['stok'];
$id_produk = $_POST['id_produk'];
$jumlah_produk = $_POST['jumlah_produk'];
$harga = $_POST['harga'];
$id_detailpenjualan = $_POST['id_detailpenjualan'];
$id_pelanggan = $_POST['id_pelanggan'];
$subtotal = $jumlah_produk *  $harga;
$stok_total = $stok - $jumlah_produk;

//menginput data
mysqli_query($koneksi,"update detailpenjualan set subtotal='$subtotal',jumlah_produk='$jumlah_produk' where id_detailpenjualan='$id_detailpenjualan'");
mysqli_query($koneksi,"update produk set stok='$stok_total' where id_produk='$id_produk'");

//mengalihkan
header("location:detail_pembelian.php?id_pelanggan=$id_pelanggan");

?>