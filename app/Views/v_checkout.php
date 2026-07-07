<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-6">
        <?= form_open('buy', 'class="row g-3"') ?>

        <?= form_hidden('username', session()->get('username')) ?>
        <?= form_input(['name' => 'total_harga', 'type' => 'hidden', 'id' => 'total_harga']) ?>

        <div class="col-12">
            <?= form_label('Nama', 'nama', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'     => 'nama',
                'id'       => 'nama',
                'class'    => 'form-control',
                'value'    => session()->get('username'),
                'readonly' => true,
            ]) ?>
        </div>

        <div class="col-12">
            <?= form_label('Alamat', 'alamat', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'  => 'alamat',
                'id'    => 'alamat',
                'class' => 'form-control',
            ]) ?>
        </div>

        <div class="col-12">
            <?= form_label('Kelurahan', 'kelurahan', ['class' => 'form-label']) ?>
            <?= form_dropdown('kelurahan', [], '', ['id' => 'kelurahan', 'class' => 'form-select']) ?>
        </div>

        <div class="col-12">
            <?= form_label('Layanan', 'layanan', ['class' => 'form-label']) ?>
            <?= form_dropdown('layanan', [], '', ['id' => 'layanan', 'class' => 'form-select']) ?>
        </div>

        <div class="col-12">
            <?= form_label('Ongkir', 'ongkir', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'     => 'ongkir',
                'id'       => 'ongkir',
                'class'    => 'form-control',
                'readonly' => true,
            ]) ?>
        </div>

        <div class="col-12">
            <?= form_submit('submit', 'Buat Pesanan', ['class' => 'btn btn-primary']) ?>
        </div>

        <?= form_close() ?>
    </div>

    <div class="col-lg-6">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($items)) : ?>
                        <?php foreach ($items as $item) : ?>
                            <tr>
                                <td><?= esc($item['name']) ?></td>
                                <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                                <td><?= esc($item['qty']) ?></td>
                                <td><?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                    <tr>
                        <td colspan="2"></td>
                        <td>Subtotal</td>
                        <td><?= number_to_currency($total, 'IDR') ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>Total</td>
                        <td><span id="total"><?= number_to_currency($total, 'IDR') ?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    let ongkir = 0;
    let subtotal = <?= $total ?>;
    hitungTotal();

    function hitungTotal() {
        let total = subtotal + ongkir;

        // Format ongkir dan total ke currency
        $("#ongkir").val(ongkir.toLocaleString('id-ID'));
        $("#total").text(`IDR ${total.toLocaleString('id-ID')}`);
        $("#total_harga").val(total);
        
        console.log('Total calculation - Subtotal:', subtotal, 'Ongkir:', ongkir, 'Total:', total);
    }

    $(document).ready(function() {
        $('#kelurahan').select2({
            placeholder: 'Cari daerah tujuan',
            minimumInputLength: 3,
            ajax: {
                url: '<?= site_url('ajax/destinations') ?>',
                dataType: 'json',
                delay: 300,
                data: function(params) {
                    return {
                        q: params.term,
                    };
                },
                processResults: function(data) {
                    return data;
                },
                cache: true,
            },
        });

        $("#kelurahan").on('change', function() {
            let id_kelurahan = $(this).val();

            $("#layanan").empty();
            ongkir = 0;
            hitungTotal();

            if (id_kelurahan) {
                $.ajax({
                    url: "<?= site_url('ajax/costs') ?>",
                    dataType: "json",
                    data: {
                        destination: id_kelurahan,
                    },
                    success: function(data) {
                        data.forEach(function(item) {
                            $("#layanan").append(
                                $('<option>', {
                                    value: item.cost,
                                    text: `${item.description} (${item.service}) : estimasi ${item.etd}`,
                                })
                            );
                        });
                    },
                });
            }
        });

        $("#layanan").on('change', function() {
            let selectedValue = $(this).val();
            console.log('Selected value:', selectedValue);
            
            if (selectedValue) {
                ongkir = parseInt(selectedValue) || 0;
            } else {
                ongkir = 0;
            }
            
            console.log('Ongkir value:', ongkir);
            hitungTotal();
        });
    });
</script>
<?= $this->endSection() ?>
