<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
        protected $with = ['user','photos','features','type'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function photos() {
        return $this->hasMany(Photo::class);
    }

   public function features() {
        return $this->belongsToMany(Feature::class);
   }



    public function getShowCreatedAtAttribute(){
        return '<p class="mb-0 small">
                    <i class="fas fa-calendar fa-fw"></i>
                     '.$this->created_at->format('d / m / Y').'
                </p>
                <p class="mb-0 small">
                    <i class="fas fa-clock fa-fw"></i>
                     '.$this->created_at->format("h:i a").'
                </p>';
    }
}
