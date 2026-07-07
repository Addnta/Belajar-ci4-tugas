<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<!-- Table with stripped rows -->
<div class="row">

    <?php foreach ($products as $item) : ?>

        <div class="col-lg-4">

            <div class="card mb-4">

                <div class="card-body">

                    <?php if (!empty($item['foto']) && file_exists(FCPATH . 'img/' . $item['foto'])) : ?>
                        <img
                            src="<?= base_url('img/' . $item['foto']) ?>"
                            width="100%"
                            alt="<?= esc($item['nama']) ?>">
                    <?php else : ?>
                        <img
                            src="<?= base_url('NiceAdmin/assets/img/product-1.jpg') ?>"
                            width="100%"
                            alt="No image available">
                    <?php endif ?>

                    <h5 class="card-title mt-3">
                        <?= esc($item['nama']) ?>
                    </h5>

                    <p class="mb-3">
                        <?= number_to_currency($item['harga'], 'IDR') ?>
                    </p>

                    <?= form_open('keranjang') ?>
                        <?= form_hidden([
                            'id'    => $item['id'],
                            'nama'  => $item['nama'],
                            'harga' => $item['harga'],
                            'foto'  => $item['foto'],
                        ]) ?>
                        <button type="submit" class="btn btn-info rounded-pill">Beli</button>
                    <?= form_close() ?>

                </div>

            </div>

        </div>

    <?php endforeach ?>

</div>
<!-- End Table with stripped rows -->
<?= $this->endSection() ?>