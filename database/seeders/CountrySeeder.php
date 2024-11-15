<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = file_get_contents(database_path('json/country.json'));

        foreach (json_decode($data) as $row) {
            Country::create([
                'id' => $row->id,
                'name' => $row->name,
            ]);
        }
    }
}
