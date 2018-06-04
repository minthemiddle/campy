<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $camps = \App\Camp::all()->sortBy('from');
        return view('welcome',compact('camps'));
    }
}
