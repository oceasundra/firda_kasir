<?php
include "header.php";
include "navbar.php";
?>
<div class="card mt-2">
    <div class="card-body">
        <?php
        include '../koneksi.php';
        $id_pelanggan = $_GET['id_pelanggan'];
        $no = 1;
        $data = mysqli_query($koneksi,"SELECT * FROM pelanggan INNER JOIN penjualan ON pelanggan.id_pelanggan=penjualan.id_pelanggan");
        while($d = mysqli_fetch_array($data)){
            ?>
            <?php if ($d['id_pelanggan'] == $id_pelanggan) { ?>
            <table>
                <tr>
                    <td>ID Pelanggan</td>
                    <td>: <?= $d['id_pelanggan']; ?></td>
                </tr>
                <tr>
                    <td>Nama Pelanggan</td>
                    <td>: <?= $d['nama_pelanggan']; ?></td>
                </tr>
                <tr>
                    <td>No. Telepon</td>
                    <td>: <?= $d['no_tlp']; ?></td>
                </tr>
                <tr>
                    <td>alamat</td>
                    <td>: <?= $d['alamat']; ?></td>
                </tr>
                <tr>
                    <td>Total Pembelian</td>
                    <td>: Rp. <?= $d['total_harga']; ?></td>
                </tr>
            </table>
            <form method="post" action="tambah_detail_penjualan.php">
                <input type="text" name="id_penjualan" value="<?= $d['id_penjualan'] ?>" hidden>
                <input type="text" name="id_pelanggan" value="<?= $d['id_pelanggan'] ?>" hidden>   
                <button type="submit" class="btn btn-primary btn-sm mt-2">Tambah Barang</button>            
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Beli</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $nos = 1;
                    $detail_penjualan = mysqli_query($koneksi,"SELECT * FROM detailpenjualan");
                    while($d_detail_penjualan = mysqli_fetch_array($detail_penjualan)){
                    ?>
                    <?php
                    if ($d_detail_penjualan['id_penjualan'] == $d['id_penjualan']) { ?>
                        <tr>
                            <td><?= $nos++; ?></td>
                            <td>
                                <form action="simpan_barang_beli.php" method="post">
                                    <div class="form-group">
                                        <input type="text" name="id_pelanggan" value="<?= $d['id_pelanggan']; ?>" hidden>
                                        <input type="text" name="id_detailpenjualan" value="<?= $d_detail_penjualan['id_detailpenjualan']; ?>" hidden>
                                        <select name="id_produk" class="form-control" onchange="this.form.submit()">
                                            <option>--- Pilih Produk ---</option>
                                            <?php
                                            include '../koneksi.php';
                                            $no = 1;
                                            $produk = mysqli_query($koneksi,"SELECT * FROM produk");
                                            while($d_produk =  mysqli_fetch_array($produk)){
                                                ?>
                                                <option value="<?= $d_produk['id_produk']; ?>" <?php if($d_produk['id_produk']==$d_detail_penjualan['id_produk']) { echo "selected"; }?>><?= $d_produk['nama_produk']; ?></option>
                                            <?php } ?>                                     
                                        </select>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="hitung_subtotal.php">
                                    <?php
                                    include '../koneksi.php';
                                    $produk = mysqli_query($koneksi,"SELECT * FROM produk");
                                    while($d_produk = mysqli_fetch_array($produk)){
                                        ?>
                                        <?php
                                        if ($d_produk['id_produk']==$d_detail_penjualan['id_produk']) { ?>
                                            <input type="text" name="harga" value=<?= $d_produk['harga']; ?> hidden>
                                            <input type="text" name="id_produk" value=<?= $d_produk['id_produk']; ?> hidden>
                                            <input type="text" name="stok" value=<?= $d_produk['stok']; ?> hidden>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="form-group">
                                        <input type="number" name="jumlah_produk" value="<?= $d_detail_penjualan['jumlah_produk']; ?>" class="form_control">
                                    </div>
                                </td>
                                <td><?= $d_detail_penjualan['subtotal']; ?></td>
                                <td>
                                    <input type="text" name="id_detailpenjualan" value="<?= $d_detail_penjualan['id_detailpenjualan']; ?>" hidden>
                                    <input type="text" name="id_pelanggan" value="<?= $d['id_pelanggan']; ?> "hidden>
                                    <button type="submit" class="btn btn-warning btn-sm mb-2">Proses</button>
                                </form>
                                <form method="post" action="hapus_detail_pembelian.php">
                                    <input type="text" name="id_pelanggan" value="<?= $d['id_pelanggan']; ?>" hidden>
                                    <input type="text" name="id_detailpenjualan" value="<?= $d_detail_penjualan['id_detailpenjualan']; ?> "hidden>
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php } else {
                        ?>
                        <?php
                    }    
                    }
                    ?>
                </tbody>
            </table>
            <form method="post" action="simpan_total_harga.php">
                <?php
                include '../koneksi.php';
                $detail_penjualan =  mysqli_query($koneksi, "SELECT SUM(Subtotal) AS total_harga FROM detailpenjualan WHERE id_penjualan='$d[id_penjualan]'");
                $row =  mysqli_fetch_assoc($detail_penjualan);
                $sum = $row['total_harga'];
                ?>
                <div class="row">
                    <div class="col-sm-10">
                        <div class="form-group">
                            <input type="text" class="form-control" name="total_harga" value="<?= $sum; ?>">
                            <input type="text"  name="id_pelanggan" value="<?= $d['id_pelanggan']; ?>" hidden>
                            <input type="text"  name="id_penjualan" value="<?= $d['id_penjualan']; ?>" hidden>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button class="btn btn-info btn-sm form-control" type="submit">simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php } else { ?>
            <?php
        }
        }
        ?>
    </div>
</div>

<?php
include "footer.php"
?>