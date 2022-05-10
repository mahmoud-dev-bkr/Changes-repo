<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function mainAdminPage()
    {
        return view("dashboard-pages.index");
    }
}
