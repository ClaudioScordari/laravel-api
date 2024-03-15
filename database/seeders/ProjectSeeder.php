<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Project;
use App\Models\Type;

// Helpers
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Project::truncate();
        });

        // Svuotare cartella img
        Storage::disk('public')->deleteDirectory('img');
        Storage::disk('public')->makeDirectory('img');

        for ($i=0; $i < 20; $i++) { 
            $project = Project::create([
                'name' => ucfirst(fake()->word()),
                'description' => fake()->text(),
                'type_id' => Type::inRandomOrder()->first()->id
            ]);
        }
    }
}
