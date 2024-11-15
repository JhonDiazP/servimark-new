<?php

namespace Database\Seeders;

use App\Models\Region;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = file_get_contents(database_path('json/region.json'));

        $arrData = [];
        foreach (json_decode($data) as $row) {

            $arrData[] = [
                'id' => $row->id,
                'country_id' => $row->country_id,
                'name' => $row->name,
            ];
        }
        if(count($arrData) > 0 ){
            Region::insert($arrData);
        }
    }
}
