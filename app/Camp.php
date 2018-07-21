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
            $registered = $this->CampUser('not_cancelled')->count();
            return $this->max - $registered;
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

    private function CampUser($status, $column = null, $comparator = null, $value = null) {
        
        switch ($status) {

            case 'not_cancelled':
                $camp_status = 'cancelled';
                $camp_status_comparator = '<>';
                break;

            case 'confirmed':
                $camp_status = 'confirmed';
                $camp_status_comparator = '=';
                break;

            case 'cancelled':
                $camp->status = 'cancelled';
                $camp_status_comparator = '=';
                break;
            
            default:
                $camp_status = 'cancelled';
                $camp_status_comparator = '<>';
                break;
        }

        if (!isset($column)){
          $options = [
            ['status', $camp_status_comparator, $camp_status],
            ['camp_id','=', $this->id],
        ];  
        }

        else {
          $options = [
            ['status', $camp_status_comparator, $camp_status],
            ['camp_id','=', $this->id],
            [$column, $comparator, $value],
        ];  
        }
        

        return DB::table('camp_user')->where($options);
    }

}
