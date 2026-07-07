<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4>Manajemen Produk</h4>
        <p class="text-muted">Kelola data produk yang tersimpan di database.</p>
    </div>
        <div>
            <a class="btn btn-success me-2" target="_blank" href="<?= base_url('produk/download') ?>">
                Download Data
            </a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah Data
            </button>
        </div>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif ?>

<?php if (session()->getFlashdata('failed')) : ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('failed') ?>
    </div>
<?php endif ?>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)) : ?>
                <?php $no = 1 ?>
                <?php foreach ($products as $item) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($item['nama']) ?></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td><?= esc($item['jumlah']) ?></td>
                        <td>
                            <?php if (!empty($item['foto']) && file_exists(FCPATH . 'img/' . $item['foto'])) : ?>
                                <img src="<?= base_url('img/' . $item['foto']) ?>" width="100" alt="<?= esc($item['nama']) ?>">
                            <?php else : ?>
                                <img src="<?= base_url('NiceAdmin/assets/img/product-1.jpg') ?>" width="100" alt="No image available">
                            <?php endif ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal-<?= $item['id'] ?>">
                                Ubah
                            </button>
                            <a href="<?= base_url('produk/delete/' . $item['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" class="text-center">Data produk tidak tersedia.</td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>

<!-- Modal Edit untuk setiap produk -->
<?php if (!empty($products)) : ?>
    <?php foreach ($products as $item) : ?>
<div class="modal fade" id="editModal-<?= $item['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel-<?= $item['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?= form_open_multipart('produk/edit/' . $item['id']) ?>
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-<?= $item['id'] ?>">Edit Data Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama-<?= $item['id'] ?>" class="form-label">Nama Barang</label>
                    <?= form_input([
                        'name' => 'nama',
                        'id' => 'nama-' . $item['id'],
                        'class' => 'form-control',
                        'value' => $item['nama'],
                        'placeholder' => 'Nama Barang',
                        'required' => true
                    ]) ?>
                </div>

                <div class="mb-3">
                    <label for="harga-<?= $item['id'] ?>" class="form-label">Harga Barang</label>
                    <?= form_input([
                        'type' => 'number',
                        'name' => 'harga',
                        'id' => 'harga-' . $item['id'],
                        'class' => 'form-control',
                        'value' => $item['harga'],
                        'placeholder' => 'Harga Barang',
                        'required' => true
                    ]) ?>
                </div>

                <div class="mb-3">
                    <label for="jumlah-<?= $item['id'] ?>" class="form-label">Jumlah Barang</label>
                    <?= form_input([
                        'type' => 'number',
                        'name' => 'jumlah',
                        'id' => 'jumlah-' . $item['id'],
                        'class' => 'form-control',
                        'value' => $item['jumlah'],
                        'placeholder' => 'Jumlah Barang',
                        'required' => true
                    ]) ?>
                </div>

                <?php if (!empty($item['foto']) && file_exists(FCPATH . 'img/' . $item['foto'])) : ?>
                    <div class="mb-3">
                        <label class="form-label">Foto Saat Ini</label><br>
                        <img src="<?= base_url('img/' . $item['foto']) ?>" width="120" alt="<?= esc($item['nama']) ?>">
                    </div>
                <?php else : ?>
                    <div class="mb-3">
                        <label class="form-label">Foto Saat Ini</label><br>
                        <img src="<?= base_url('NiceAdmin/assets/img/product-1.jpg') ?>" width="120" alt="No image available">
                    </div>
                <?php endif ?>

                <div class="form-check mb-3">
                    <?= form_checkbox([
                        'name' => 'check',
                        'id' => 'check-' . $item['id'],
                        'value' => '1',
                        'class' => 'form-check-input'
                    ]) ?>
                    <?= form_label('Ganti Foto', 'check-' . $item['id'], ['class' => 'form-check-label']) ?>
                </div>

                <div class="mb-3">
                    <label for="foto-<?= $item['id'] ?>" class="form-label">Foto Baru</label>
                    <?= form_upload([
                        'name' => 'foto',
                        'id' => 'foto-' . $item['id'],
                        'class' => 'form-control'
                    ]) ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <?= form_submit('submit', 'Simpan Perubahan', ['class' => 'btn btn-primary']) ?>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
    <?php endforeach ?>
<?php endif ?>

<?= $this->include('produk/modal_add') ?>

<?= $this->endSection() ?>