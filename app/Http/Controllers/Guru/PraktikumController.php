<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Praktikum;

class PraktikumController extends Controller
{
    public function index()
    {
        $page_title = 'Praktikum Kelas Saya';
        $page_description = 'Data praktikum guru';
        $action = 'app_calender';
        $praktikum = Praktikum::all();
        return view('guru.praktikum', compact('page_title', 'page_description','action','praktikum'));
    }
}
