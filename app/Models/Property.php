<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\PropertyItem;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        "label",
        "title",
        "property_id",
        "contact_number",
        "price",
        "space",
        "district",
        "location",
        "rooms",
        "dev_name",
        "ready_construction",
        "property_type",
        "roof",
        "description",
        "post_by",
        "user_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id', 'id');
    }

    /**
     * Get the lead attributes except for the specified columns.
     *
     * @param  array  $columns
     * @return array
     */
    public function getAttributesExcept(array $columns = [])
    {
        // Get all attributes and exclude specified columns
        return collect($this->attributes)->except($columns)->toArray();
    }
}
