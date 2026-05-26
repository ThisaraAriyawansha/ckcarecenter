<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PackagesController extends Controller
{

    public function index(): View
    {
        return view('frontend.packages.index');
    }

}