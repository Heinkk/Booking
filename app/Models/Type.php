<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class);
    }

//    public function type() {
//        return $this->hasOne(Room::class);
//    }
}
