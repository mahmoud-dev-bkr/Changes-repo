<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class LandpageController extends Controller
{
    function HomePage()
    {
        $plans = Plan::all(); 
        return view("landpage.index", [
            'plans' => $plans
        ]);
    }

    function TermsPage()
    {
        return view("landpage.terms");
    }
}
