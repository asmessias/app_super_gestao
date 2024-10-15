<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobrenosController extends Controller
{

    public function __construct() {
        $this->middleware('log.acesso');
    }

    public function sobrenos(){
        return view('site.sobrenos');
    }
}
