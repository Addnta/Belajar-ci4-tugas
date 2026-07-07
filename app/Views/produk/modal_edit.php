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