<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            ['city' => 'New York', 'state' => 'New York', 'country' => 'USA'],
            ['city' => 'Los Angeles', 'state' => 'California', 'country' => 'USA'],
            ['city' => 'London', 'state' => 'England', 'country' => 'UK'],
            ['city' => 'Berlin', 'state' => 'Berlin', 'country' => 'Germany'],
            ['city' => 'Tokyo', 'state' => 'Tokyo', 'country' => 'Japan'],
            ['city' => 'Paris', 'state' => 'Île-de-France', 'country' => 'France'],
            ['city' => 'Toronto', 'state' => 'Ontario', 'country' => 'Canada'],
            ['city' => 'Sydney', 'state' => 'New South Wales', 'country' => 'Australia'],
            ['city' => 'Dubai', 'state' => 'Dubai', 'country' => 'UAE'],
            ['city' => 'São Paulo', 'state' => 'São Paulo', 'country' => 'Brazil'],
        ];

        DB::table('locations')->insert($locations);
    }
}
