<?php

namespace Database\Seeders;

use App\Enums\AttributeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            ['name' => 'Experience Level', 'type' => AttributeType::Select->value, 'options' => json_encode(['Entry Level', 'Mid Level', 'Senior Level'])],
            ['name' => 'Required Skills', 'type' => AttributeType::Select->value, 'options' => json_encode(['PHP', 'Laravel', 'React', 'Flutter', 'MySQL'])],
            ['name' => 'Education Level', 'type' => AttributeType::Select->value, 'options' => json_encode(['High School', 'Bachelor\'s', 'Master\'s', 'PhD'])],
            ['name' => 'Industry', 'type' => AttributeType::Select->value, 'options' => json_encode(['IT', 'Finance', 'Healthcare', 'Education'])],
            ['name' => 'Years of Experience', 'type' => AttributeType::Number->value, 'options' => null],
            ['name' => 'Language Requirements', 'type' => AttributeType::Select->value, 'options' => json_encode(['English', 'French', 'Spanish', 'German'])],
            ['name' => 'Work Permit Required', 'type' => AttributeType::Boolean->value, 'options' => null],
        ];

        DB::table('attributes')->insert($attributes);
    }
}
