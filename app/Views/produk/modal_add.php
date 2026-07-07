<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?= form_open_multipart('produk') ?>
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Barang</label>
                    <?= form_input([
                        'name' => 'nama',
                        'id' => 'nama',
                        'class' => 'form-control',
                        'placeholder' => 'Nama Barang',
                        'required' => true
                    ]) ?>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga Barang</label>
                    <?= form_input([
                        'type' => 'number',
                        'name' => 'harga',
                        'id' => 'harga',
                        'class' => 'form-control',
                        'placeholder' => 'Harga Barang',
                        'required' => true
                    ]) ?>
                </div>

                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah Barang</label>
                    <?= form_input([
                        'type' => 'number',
                        'name' => 'jumlah',
                        'id' => 'jumlah',
                        'class' => 'form-control',
                        'placeholder' => 'Jumlah Barang',
                        'required' => true
                    ]) ?>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Barang</label>
                    <?= form_upload([
                        'name' => 'foto',
                        'id' => 'foto',
                        'class' => 'form-control'
                    ]) ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <?= form_submit('submit', 'Simpan', ['class' => 'btn btn-primary']) ?>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>