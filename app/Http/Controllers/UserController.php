<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
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
    public function update(Request $request, User $user)
    {
        $passedID = Str::after($request->path(), '/');
        $loggedUser = Auth::user()->id;

        if ($passedID == $loggedUser) {
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'birthdate' => 'required',
                'diet' => 'required',
                'mobile' => 'required',
                'zip' => 'required|numeric|regex:/\d{5}/'
            ]);

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->birthdate = $request->birthdate;
            $user->diet = $request->diet;
            $user->mobile = $request->mobile;
            $user->instagram = $request->instagram;
            $user->twitter = $request->twitter;
            $user->zip = $request->zip;
            $user->complete = 1;
            $user->save();

            return redirect('home');
        } else {
            Session::flash('info', 'Denkste! Du kannst natürlich nur deine eigenen Daten ändern…');
            return redirect('home');
        }
        

        

        // $diets = [
        //     0 => 'normal',
        //     1 => 'vegetarian',
        //     2 => 'vegan',
        //     3 => 'halal',
        //     4 => 'glutenfree',
        //     5 => 'lactosefree'
        // ]; 

        // $user = Auth::user();
        // $selected_diet = $user->diet;
        // return view('home',compact('user', 'selected_diet', 'diets'));

    }
}
