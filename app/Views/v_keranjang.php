<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<?php if (!empty($items)) : ?>

    <?= form_open('keranjang/edit') ?>

    <div class="table-responsive">
        <table class="table datatable">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($items as $item) : ?>
                    <tr>
                        <td><?= esc($item['name']) ?></td>
                        <td>
                            <?php if (!empty($item['options']['foto']) && file_exists(FCPATH . 'img/' . $item['options']['foto'])) : ?>
                                <img src="<?= base_url('img/' . $item['options']['foto']) ?>" width="100" alt="<?= esc($item['name']) ?>">
                            <?php else : ?>
                                <span>Tidak ada gambar</span>
                            <?php endif ?>
                        </td>
                        <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                        <td>
                            <input type="number" min="1" name="qty<?= $i++ ?>" class="form-control" value="<?= esc($item['qty']) ?>">
                        </td>
                        <td><?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
                        <td>
                            <a href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini dari keranjang?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-primary">Perbarui Keranjang</button>
    <?= form_close() ?>

    <div class="alert alert-info mt-3">
        <?= 'Total = ' . number_to_currency($total, 'IDR') ?>
    </div>

    <div class="mt-3">
        <a class="btn btn-warning" href="<?= base_url() ?>keranjang/clear" onclick="return confirm('Kosongkan seluruh keranjang?')">Kosongkan Keranjang</a>
        <a class="btn btn-success" href="<?= base_url() ?>checkout">Selesai Belanja</a>
    </div>

<?php else : ?>

    <div class="text-center py-5">
        <i class="bi bi-cart-x" style="font-size: 4rem; color: #ccc;"></i>
        <h3 class="mt-3 text-muted">Keranjang Anda Kosong</h3>
        <p class="text-muted">Belum ada produk dalam keranjang Anda. Silakan lanjutkan berbelanja.</p>
        <a href="<?= base_url() ?>" class="btn btn-primary mt-3">Kembali ke Berbelanja</a>
    </div>

<?php endif; ?>

<?= $this->endSection() ?>
