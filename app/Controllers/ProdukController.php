<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use chillerlan\QRCode\QRCode;
use Dompdf\Dompdf;

class ProdukController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        helper('form');
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $qr = new QRCode();

        return view('produk/index', [
            'products' => $this->productModel->findAll(),
            'qr'       => $qr,
        ]);
    }

    public function qr()
    {
        $qr = new QRCode();

        return view('produk/qr', [
            'qr' => $qr,
        ]);
    }

    public function create()
    {
        $dataFoto = $this->request->getFile('foto');

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'jumlah' => $this->request->getPost('jumlah')
        ];

        if ($dataFoto && $dataFoto->isValid()) {
            $fileName = $dataFoto->getRandomName();
            $dataFoto->move('img/', $fileName);
            $dataForm['foto'] = $fileName;
        }

        $this->productModel->insert($dataForm);

        return redirect()->to('/produk')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $dataProduk = $this->productModel->find($id);

        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'jumlah' => $this->request->getPost('jumlah')
        ];

        if ($this->request->getPost('check') == 1) {
            if (!empty($dataProduk['foto']) && file_exists(FCPATH . 'img/' . $dataProduk['foto'])) {
                unlink(FCPATH . 'img/' . $dataProduk['foto']);
            }

            $dataFoto = $this->request->getFile('foto');

            if ($dataFoto && $dataFoto->isValid()) {
                $fileName = $dataFoto->getRandomName();
                $dataFoto->move('img/', $fileName);
                $dataForm['foto'] = $fileName;
            }
        }

        $this->productModel->update($id, $dataForm);

        return redirect()->to('/produk')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $dataProduk = $this->productModel->find($id);

        if (!empty($dataProduk['foto']) && file_exists(FCPATH . 'img/' . $dataProduk['foto'])) {
            unlink(FCPATH . 'img/' . $dataProduk['foto']);
        }

        $this->productModel->delete($id);

        return redirect()->to('/produk')->with('success', 'Data Berhasil Dihapus');
    }

    public function download()
    {
        $products = $this->productModel->findAll();

        $html = view('produk/download_pdf', [
            'products' => $products,
        ]);

        $filename = date('Y-m-d-H-i-s') . '-produk.pdf';

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename, [
            'Attachment' => true,
        ]);
    }
}
