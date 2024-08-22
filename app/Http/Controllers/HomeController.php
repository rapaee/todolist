<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $nama = 'Rafa';
        $data = ['nama' => $nama];
        return view('home', $data);
    }
}
