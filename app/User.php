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
            if (isset($this->birthdate)) {
                $birth = Carbon::instance($this->birthdate);
                $birth = $birth->age;
            } else {
                $birth = 0;
            }
            return $birth;
    }

    public function getBirthFormattedAttribute()
    {
            if (isset($this->birthdate)) {
                $birth = Carbon::instance($this->birthdate);
                $birth->toDateString();
            } else {
                $birth = null;
            }
            return $birth;
    }

    public function camps()
    {
        return $this->belongsToMany(Camp::class)
            ->withTimestamps()
            ->withPivot('status', 'contribution', 'laptop', 'needs_laptop', 'tos', 'consent', 'comment', 'admin_comment', 'reason_for_cancellation');
    }

}
