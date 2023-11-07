<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromocaoController extends Controller
{
    public function promocao() {
        return view('promocao');
    }
}
