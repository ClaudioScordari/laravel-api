<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Project;
use App\Models\Technology;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();

	    foreach ($projects as $project) {
            // prendo un gruppo di tecnologie da 0 a 3
		    $technologies = Technology::inRandomOrder()->take(rand(0, 3))->get();

            // e per ogni tecnologia attacco un loro id al singolo progetto
            foreach ($technologies as $technology) {
                $project->technologies()->attach($technology->id);
            }
	    }
    }
}
