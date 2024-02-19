<?php
//koneksi database
include '../koneksi.php';

//menangkap data yang dikirim
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

//menginput data
mysqli_query($koneksi,"insert into petugas values('','$nama','$username','$password','$level')");

//mengalihkan
header("location:data_pengguna.php?pesan=simpan");

?>