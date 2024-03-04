<?php

namespace App\Imports;

use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class PropertiesImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $user = Auth::user();
        return new Property([
            "title" => $row[0],
            "sqrfit" => $row[1],
            "bed" => $row[2],
            "bath" => $row[3],
            "room" => $row[4],
            "location" => $row[5],
            "price" => $row[6],
            "classification" => $row[7],
            "type" => $row[8],
            "dev_name" => $row[9],
            "sell_type" => $row[10],
            "rent_status" => $row[11],
            "status" => 'pending',
            "thumb" => $row[13],
            "slider1" => $row[14],
            "slider2" => $row[15],
            "slider3" => $row[16],
            "slider4" => $row[17],
            "description" => $row[18],
            "post_by" => $user->type,
            "user_id" => $user->id,
        ]);
    }
}
