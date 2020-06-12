<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class FrontendController extends Controller
{
    public function app()
    {
        return view('app');
    }

    public function admin()
    {
        return view('admin');
    }
}
