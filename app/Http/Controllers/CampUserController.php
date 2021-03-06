<?php

namespace App\Http\Controllers;

use App\Camp;
use App\CampUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CampUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $camp_user = Auth::user()->camps->sortBy('from');
        return view('camp_user.index', compact('user', 'camp_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Camp $camp = null)
    {
        $user = Auth::user();
        $age = Auth::user()->age;
        return view('camp.create', compact('user', 'camp', 'age'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Camp $camp, User $user)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'tos' => 'required',
            'consent' => 'required',
            'laptop' => 'required',
            'contribution' => 'required'
        ]);

        $user = User::find($request->user);
        $camp_registered = $request->camp;
        $tos = $request->tos;
        $consent = $request->consent;
        $laptop = $request->laptop;
        $contribution = $request->contribution;
        $comment = $request->comment;

        $camp = Camp::find($camp_registered);

        if ($camp->free_spots <= 0) {
            $status = 'waiting';
        }
        else {
            $status = 'registered';
        }

        $user->camps()->syncWithoutDetaching([$camp_registered => [
            'status' => $status,
            'consent' => $consent,
            'tos' => $tos,
            'laptop' => $laptop,
            'contribution' => $contribution,
            'comment' => $comment,
        ]]);

        return redirect('/mycamps');

        // that worked
        // $user->camps()->attach($camp_registered, [
        //     'status' => 'registered'
        // ]);

        // define camp
        // $camp = Camp::find($request->campid)->first();
        // a, heck whether camp in the future
        // b, check whether still free spots
        //
        // if a + b = TRUE
        // save personal data -> USER
        // save camp registration -> CampUser
    }

    /**
     * Display the specified resource.
     * Display the single camp registration for a USER
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Camp $camp)
    {
        return view('camp_user.show', compact('camp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Camp $camp)
    {
       $user = Auth::user();
       $camp = $user->camps()->where('camp_id', $id)->first();

        return view('camp_user.show', compact('camp', 'user'));
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
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'laptop' => 'required',
            'contribution' => 'required'
        ]);

        $passedID = Str::after($request->path(), '/');
        $loggedUser = Auth::user()->id;

        if ($passedID == $loggedUser) {
            $user = User::find($request->user);
            $camp_registered = $request->camp;
            $laptop = $request->laptop;
            $contribution = $request->contribution;
            $comment = $request->comment;
            $reason = $request->reason_for_cancellation;

            if (isset($reason)){
                $status = 'cancelled';

            $user->camps()->syncWithoutDetaching([$camp_registered => [
                'status' => $status,
                'comment' => $comment,
                'reason_for_cancellation' => $reason
            ]]);
            }

            else {
               $user->camps()->syncWithoutDetaching([$camp_registered => [
                'contribution' => $contribution,
                'laptop' => $laptop,
                'comment' => $comment
            ]]); 
            }

            

            return redirect('/mycamps');
        } else {
            Session::flash('info', 'Denkste! Du kannst natürlich nur deine eigenen Daten ändern…');
            return redirect('/mycamps');
        }

        
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


    // public function showmycamps()
    // {
    //     
    // }

    // public function savemycamps()
    // {
    //     // 
    //     // if 
    // }
