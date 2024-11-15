<?php

namespace Database\Seeders;

use App\Models\TypeDocument;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = file_get_contents(database_path('json/type_document.json'));

        foreach (json_decode($data) as $row) {
            TypeDocument::create([
                'name' => $row->name,
            ]);
        }
    }
}
