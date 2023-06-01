<?php

namespace Database\Seeders;

use App\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
   /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            [
                'name' => 'Project 1',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Project 2',
            'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Project 3',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Project 4',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Project 5',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Project 6',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'Project 7',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        if(Project::count() == 0) {
            foreach($projects as $k => $project) {
                Project::create([
                    'project_name' => $project['name'],
                ]);
            }
        }
    }
}
