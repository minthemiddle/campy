<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CampUser extends Pivot
{
    public function getTransactionAttribute()
    {
            // if payer
            return 'Betreff: Igor K koe1805';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function camp()
    {
        return $this->belongsTo(Camp::class);
    }

}
