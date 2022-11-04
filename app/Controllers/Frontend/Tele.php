<?php

namespace App\Controllers\Frontend;

use App\Models\FrontModel;

class Tele extends BaseController
{
    protected $helper = [];

    public function __construct()
    {
        helper(['form']);
        helper(['Tanggal']);
    }

    public function index()

    {
        $data = [
            'judul' => 'KitaGarut',
            'menu' => 'KitaGarut',
            'submenu' => 'KitaGarut',
        ];

        return view('frontend/tele', $data);
    }
}
