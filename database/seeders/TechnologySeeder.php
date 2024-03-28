<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $project_ids = Project::pluck('id')->toArray();
        $technologies = [
            ['label' => 'HTML', 'color' => 'danger'],
            ['label' => 'CSS', 'color' => 'primary'],
            ['label' => 'ES6', 'color' => 'warning'],
            ['label' => 'Bootstrap', 'color' => 'dark'],
            ['label' => 'Vue', 'color' => 'success'],
            ['label' => 'SQL', 'color' => 'secondary'],
            ['label' => 'PHP', 'color' => 'info'],
            ['label' => 'Laravel', 'color' => 'light'],

        ];
        foreach ($technologies as $technology) {
            $new_technology = new Technology();
            $new_technology->label = $technology['label'];
            $new_technology->color = $technology['color'];
            $new_technology->save();

            // $technology_projects = [];
            // foreach ($project_ids as $project_id) {
            //     if (rand(0, 1)) $technology_projects[] = $project_id;
            // }

            //Stessa cosa pi breve
            $technology_projects = array_filter($project_ids, fn () => rand(0, 1));

            /*questa riga di codice associa tutti i progetti 
            esistenti alla tecnologia corrente.
            Questa parte :$new_technology->projects(), recuperara tutti i progetti 
            associati a una determinata tecnologia.
            Mentre questa parte: ->attach($project_ids) esegue un'operazione 
            per associare i progetti con gli ID presenti nell'array $project_ids 
            alla tecnologia corrente.*/
            $new_technology->projects()->attach($technology_projects);
        }
    }
}
