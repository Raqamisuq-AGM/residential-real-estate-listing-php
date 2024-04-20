<?php

namespace App\Imports;

use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PropertiesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $user = Auth::user();
        // Generate a unique ID
        // $uniqueId = 'offer#' . mt_rand(100, 999); // Generates a random number between 100 and 999
        // while (Property::where('property_id', $uniqueId)->exists()) {
        //     $uniqueId = 'offer#' . mt_rand(100, 999); // Regenerate if the ID already exists
        // }

        $lastId = Property::max('property_id');
        $nextId = $lastId ? (int)$lastId + 1 : 1;

        return new Property([
            "title" => $row['title'],
            "property_id" => $nextId,
            "contact_number" => $row['contact_number'],
            "price" => $row['price'],
            "space" => $row['space'],
            "district" => $row['district'],
            "location" => $row['location'],
            "rooms" => $row['rooms'],
            "dev_name" => $row['dev_name'],
            "ready_construction" => $row['ready_construction'],
            "property_type" => $row['property_type'],
            "roof" => $row['roof'],
            "description" => $row['description'],
            "post_by" => $user->type,
            "user_id" => $user->id,
        ]);
    }
}
