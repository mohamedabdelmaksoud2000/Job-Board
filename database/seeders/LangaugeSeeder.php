<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LangaugeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'PHP'],
            ['name' => 'JavaScript'],
            ['name' => 'Python'],
            ['name' => 'Java'],
            ['name' => 'C#'],
            ['name' => 'C++'],
            ['name' => 'Ruby'],
            ['name' => 'Swift'],
            ['name' => 'Go'],
            ['name' => 'Kotlin'],
        ];

        DB::table('languages')->insert($languages);
    }
}
