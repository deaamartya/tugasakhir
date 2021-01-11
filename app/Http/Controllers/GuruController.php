<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function dashboard()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $action = 'dashboard_1';
        return view('guru.dashboard', compact('page_title', 'page_description','action'));
    }
}
