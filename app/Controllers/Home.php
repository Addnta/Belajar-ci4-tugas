<?php

namespace App\Controllers;
use App\Models\ProductModel;

class Home extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        helper(['form', 'number']);
        $this->productModel = new ProductModel();
    }
    
    public function index()
    {
        // Ambil semua produk dari database untuk ditampilkan di halaman home
        $data['products'] = $this->productModel->findAll();

        return view('v_home', $data);
    }
}
