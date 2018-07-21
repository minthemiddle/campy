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
        return $this->CampUser('not_cancelled')->count();
    }

    public function getStatusAttribute()
    {
        if ($this->free_spots < 1){
            return 'Warteliste';
        }
        else {
            return 'Freie Plätze';
        }
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

            case 'registered':
                $camp_status = 'registered';
                $camp_status_comparator = '=';
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
