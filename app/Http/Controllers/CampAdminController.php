<?php

namespace App\Http\Controllers;

use App\Camp;
use App\CampUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CampAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        // get all camps with 
        $camps = Camp::with('users')->get();
        // get number of required laptops
        // Camp::with('users')->where('')
        // $laptops = Camp::with(['users' => function ($query) {
        //         $query->where('laptop', '=', 'payer');
        //     }])->get();
        $last = CampUser::all();
        $last = $last->sortByDesc('created_at')->take(3);

        if ($user->role === 'admin') {
            return view('admin.show', compact('camps', 'laptops', 'last'));
        } else {
            return 'Not authorized';
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
