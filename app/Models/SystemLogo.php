<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemLogo extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'fav',
        'image',
        'color',
    ];
}
