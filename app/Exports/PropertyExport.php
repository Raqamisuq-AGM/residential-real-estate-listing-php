<?php

namespace App\Exports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PropertyExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Property::all()->map(function ($property) {
            return $property->getAttributesExcept(['id', 'post_by', 'user_id ', 'created_at', 'updated_at']);
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define the headers for the exported data
        return [
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
        ];
    }
}
