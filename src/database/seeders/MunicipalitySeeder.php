<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Municipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = file_get_contents(database_path('json/municipality.json'));

        foreach (json_decode($data) as $row) {

            Municipality::create([
                'id' => $row->id,
                'name' => $row->name,
                'departament_id' => $row->region_id,
            ]);
        }
    }
}
