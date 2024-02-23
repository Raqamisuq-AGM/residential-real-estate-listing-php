<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "sqrfit",
        "bed",
        "bath",
        "room",
        "location",
        "price",
        "classification",
        "type",
        "dev_name",
        "sell_type",
        "rent_status",
        "status",
        "thumb",
        "slider1",
        "slider2",
        "slider3",
        "slider4",
        "slider4",
        "description",
        "post_by",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
