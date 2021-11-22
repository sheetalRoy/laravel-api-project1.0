<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    public function coaches()
    {
        return $this->belongsToMany(Coaches::class, 'coaches_areas');
    }
}
