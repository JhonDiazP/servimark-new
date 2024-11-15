<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = file_get_contents(database_path('json/role.json'));

        foreach (json_decode($data) as $row) {
            Role::create([
                'name' => $row->name,
            ]);
        }
    }
}
