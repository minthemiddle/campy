<?php

namespace App\Http\Controllers;

use App\Camp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diets = [
            0 => 'normal',
            1 => 'vegetarian',
            2 => 'vegan',
            3 => 'halal',
            4 => 'glutenfree',
            5 => 'lactosefree'
        ];        
        
        $user = Auth::user();
        $selected_diet = $user->diet;
        return view('home',compact('user', 'selected_diet', 'diets'));
    }
}
