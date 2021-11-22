<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coaches extends Model
{
    //
    public function areas()
    {
        return $this->belongsToMany(Area::class, 'coaches_areas');
    }
}
