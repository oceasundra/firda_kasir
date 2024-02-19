<?php
include '../koneksi.php';
include "header.php";
include "navbar.php";
?>
<div class="card mt-2">
    <div class="card-body">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
            Tambah Data
        </button>
    </div>
    <div class="card-body">
        <?php
        if(isset($_GET['pesan'])){
            if($_GET['pesan']=="simpan"){?>
            <div class="alert alert-success" role="alert">
                Data Berhasil DI Simpan
            </div>
        <?php } ?>
        <?php if($_GET['pesan']=="update"){?>
            <div class="alert alert-success" role="alert">
                Data Berhasil Di Update
            </div>
            <?php } ?>
        <?php if($_GET['pesan']=="hapus"){?>
            <div class="alert alert-success" role="alert">
                Data Berhasil Di Hapus
            </div>
            <?php } ?>
            <?php
        }
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>No. Telepon</th>
                    <th>alamat</th>
                    <th>Total Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $data = mysqli_query($koneksi,"SELECT * from pelanggan INNER JOIN penjualan ON pelanggan.id_pelanggan=penjualan.id_pelanggan");
                while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['id_pelanggan']; ?></td>
                        <td><?= $d['nama_pelanggan']; ?></td>
                        <td><?= $d['no_tlp']; ?></td>
                        <td><?= $d['alamat']; ?></td>
                        <td><?= $d['total_harga']; ?></td>
                        <td>
                            <a href="detail_pembelian.php?id_pelanggan=<?= $d['id_pelanggan'] ?>" class="btn btn-info btn-sm">Detail</a>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?= $d['id_pelanggan'] ?>" <?= $d['id_pelanggan']; ?>>
                                Edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?= $d['id_pelanggan'] ?>" <?= $d['id_pelanggan']; ?>>
                                Hapus
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Edit Data -->
                    <div class="modal fade" id="edit-data<?= $d['id_pelanggan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses_update_pembelian.php" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" name="id_pelanggan" class="form-control" hidden value="<?= $d['id_pelanggan']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Pelanggan</label>
                                            <input type="text" name="nama_pelanggan" class="form-control" value="<?= $d['nama_pelanggan']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <input type="text" name="no_tlp" class="form-control" value="<?= $d['no_tlp']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" name="alamat" class="form-control" value="<?= $d['alamat']; ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Hapus Data -->
                    <div class="modal fade" id="hapus-data<?= $d['id_pelanggan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="proses_hapus_pembelian.php" method="post">
                                    <div class="modal-body">
                                        <input type="hidden" name="id_pelanggan" value="<?= $d['id_pelanggan']; ?>">
                                        Apakah anda yakin akan menghapus data <b><?= $d['nama_pelanggan']; ?></b>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>   
</div>
<!-- Modal Tambah Data -->
<div class="modal fade" id="tambah-data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="proses_pembelian.php" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <label>ID Pelanggan</label>
                    <input type="text" name="id_pelanggan" value="<?= date("dmHis") ?>" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control">
                </div>
                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="no_tlp" class="form-control">
                </div>
                <div class="form-group">
                    <label>alamat</label>
                    <input type="text" name="alamat" class="form-control">
                    <input type="hidden" name="tanggal_penjualan" value="<?= date("Y-m-d") ?>" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
</div>
<?php
include "footer.php";
?>