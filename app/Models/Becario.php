<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Becario extends Model
{
    use HasFactory;

        /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function escuela()
    {
        return $this->hasOne('App\Models\Escuela', 'id', 'escuela_id');
    }
}
