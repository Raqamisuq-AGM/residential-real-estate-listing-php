<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "property_id",
        "contact_number",
        "price",
        "space",
        "district",
        "rooms",
        "dev_name",
        "ready_construction",
        "property_type",
        "description",
        "post_by",
        "user_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
