<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Produk</title>
    <style>
        body { font-family: sans-serif; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
        img { display: block; max-width: 80px; max-height: 80px; }
    </style>
</head>
<body>
    <h1>Data Produk</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $index => $produk) : ?>
                <?php
                    $path = FCPATH . 'img/' . $produk['foto'];
                    $base64 = '';

                    if (!empty($produk['foto']) && file_exists($path)) {
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    }
                ?>
                <tr>
                    <td align="center"><?= $index + 1 ?></td>
                    <td><?= esc($produk['nama']) ?></td>
                    <td align="right">Rp <?= number_format($produk['harga'], 2, ',', '.') ?></td>
                    <td align="center"><?= esc($produk['jumlah']) ?></td>
                    <td align="center">
                        <?php if ($base64) : ?>
                            <img src="<?= $base64 ?>" width="50" alt="<?= esc($produk['nama']) ?>">
                        <?php else : ?>
                            Tidak ada gambar
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <p>Downloaded on <?= date('Y-m-d H:i:s') ?></p>
</body>
</html>
