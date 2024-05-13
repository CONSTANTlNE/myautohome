<?php

namespace App\Imports;

use App\Models\Car;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CarsImport implements ToModel,withHeadingRow
{
    public function model(array $row)
    {
        // Create a new Book model instance and populate it with data from the given row.
        return new Car([
            'make' => $row['make'][2],
        ]);
    }
}
