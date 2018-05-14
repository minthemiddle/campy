<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $dates = ['birthdate'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'birthdate', 'zip', 'diet'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAgeAttribute()
    {
            $fallback = Carbon::now();
            if (isset($this->birthdate)) {
                $birth = Carbon::instance($this->birthdate);
            } else {
                $birth = $fallback;
            }
            return $birth->age;
    }

    public function getBirthFormattedAttribute()
    {
            $fallback = Carbon::now();
            if (isset($this->birthdate)) {
                $birth = Carbon::instance($this->birthdate);
            } else {
                $birth = $fallback;
            }
            return $birth->format('Y-m-d');
    }

    public function camps()
    {
        return $this->belongsToMany(Camp::class)
            ->withTimestamps()
            ->withPivot('status', 'contribution', 'laptop', 'tos', 'consent', 'comment', 'reason_for_cancellation');
    }

}
