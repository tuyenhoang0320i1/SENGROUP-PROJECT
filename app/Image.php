<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function house()
    {
        return $this->belongsTo('App\House', 'house_id', 'id');
    }
}
