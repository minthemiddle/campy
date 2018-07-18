<?php

namespace App;

use App\Camp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Camp extends Model
{

    protected $dates = ['from', 'to', 'registration_start', 'registration_end'];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot('status', 'contribution', 'laptop', 'tos', 'consent');
    }

    public function getFreeSpotsAttribute()
    {
            $registered = DB::table('camp_user')->where('camp_id', $this->id)->count();
            $max = DB::table('camps')->where('id', $this->id)->first();
            $max = $max->max;
            $free = $max-$registered;

            if ($free < 0) {
                $free = 0;
            }
            // $free = "($max max, $free frei)";
            return $free;
    }

    public function getTotalParticipantsAttribute()
    {
            $registered = DB::table('camp_user')->where('camp_id', $this->id)->count();
            return $registered;
    }

    public function getStatusAttribute()
    {
            $registered = DB::table('camp_user')->where('camp_id', $this->id)->count();
            $max = DB::table('camps')->where('id', $this->id)->first();
            $max = $max->max;
            $free = $max-$registered;

            if ($free < 0) {
                $free = 'Warteliste';
            }
            else {
                $free = 'Freie Plätze';
            }
            return $free;
    }

    public function getOrderedLaptopsAttribute()
    {
        return DB::table('camp_user')->where([['camp_id','=', $this->id],['laptop','<>', 'own'],])->count();
    }

}
