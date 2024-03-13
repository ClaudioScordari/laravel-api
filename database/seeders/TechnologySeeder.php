<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Technology;

// Helpers
use Illuminate\Support\Facades\Schema;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            Technology::truncate();
        });

        // Array contente usa serie di tecnologie
        $technologies = [
            "Intelligenza Artificiale",
            "Apprendimento Automatico",
            "Blockchain",
            "Internet delle Cose",
            "Cloud Computing",
            "Realtà Virtuale",
            "Cybersecurity",
            "Big Data",
            "Sviluppo Web Full Stack",
            "Automazione dei Processi Robotici"
        ];

        foreach ($technologies as $oneTechnology) {
            $technology = Technology::create([
                'name' => $oneTechnology
            ]);
        }
        
    }
}
