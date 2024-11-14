<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = file_get_contents(database_path('json/gender.json'));

        foreach (json_decode($data) as $row) {
            Gender::create([
                'id' => $row->id,
                'name' => $row->name,
            ]);
        }
    }
}
