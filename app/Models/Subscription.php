<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['email', 'website_id'];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function postDeliveries()
    {
        return $this->hasMany(PostDelivery::class);
    }
}

