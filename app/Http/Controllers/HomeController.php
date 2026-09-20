<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the DMI Healths landing page.
     */
    public function index()
    {
        return view('home', [
            'title' => 'DMI Healths — Support for Intellectual Disability',
        ]);
    }
}
