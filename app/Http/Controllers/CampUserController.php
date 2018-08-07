<?php

namespace App\Http\Controllers;

use App\Camp;
use App\CampUser;
use App\Mail\ContributionConfirmed;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
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
        $age = $user->age;
        return view('camp.create', compact('user', 'camp', 'age'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Camp $camp)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'tos' => 'required',
            'consent' => 'required',
            'laptop' => 'required',
            'contribution' => 'required'
        ]);

        $user = Auth::user();
        $camp_registered = $request->camp;
        $tos = $request->tos;
        $consent = $request->consent;
        $laptop = $request->laptop;
        $contribution = $request->contribution;
        $comment = $request->comment;

        $camp = Camp::find($camp_registered);

        if ($camp->free_spots < 1) {
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

        $passedID = $request->user;
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

    public function updateTransaction(Request $request, $camp, $user, CampUser $campuser){

        $userProfile = User::where('id','=',$user)->first();

        $camp_user = \App\CampUser::where([
                    ['user_id', '=', $user],
                    ['camp_id', '=', $camp],
                ])->first();

        if ($camp_user->status == 'registered') {
            $camp_user->status = 'confirmed';
            $camp_user->save();

        }

        if ($userProfile->age < 18)
        {
           Mail::to($userProfile->email)
            ->cc($userProfile->guardian_email)
            ->send(new ContributionConfirmed($camp)); 
        }
        else {
           Mail::to($userProfile->email)
            ->send(new ContributionConfirmed($camp)); 
        }
    
        
        return redirect()->back();
    }

    public function updateLaptopTransaction(Request $request, $camp, $user){

        $camp_user = \App\CampUser::where([
                    ['user_id', '=', $user],
                    ['camp_id', '=', $camp],
                ])->first();

        if ($camp_user->laptop == 'payer') {
            $camp_user->laptop = 'paid';
            $camp_user->save();

        }
    
        return redirect()->back();
    }

}