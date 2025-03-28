<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Technology'],
            ['name' => 'Business'],
            ['name' => 'Health & Wellness'],
            ['name' => 'Education'],
            ['name' => 'Entertainment'],
            ['name' => 'Science'],
            ['name' => 'Sports'],
            ['name' => 'Lifestyle'],
            ['name' => 'Finance'],
            ['name' => 'Travel'],
        ];

        DB::table('categories')->insert($categories);
    }
}
