<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $action = 'dashboard_1';
        return view('admin.dashboard', compact('page_title', 'page_description','action'));
    }
}
