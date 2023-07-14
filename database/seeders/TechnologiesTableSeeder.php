<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            [
                'name' => 'PHP',
            ],
            [
                'name' => 'Laravel',
            ],
            [
                'name' => 'javaScript',
            ],
            [
                'name' => 'html',
            ],
            [
                'name' => 'CSS',
            ],
        ];
        
        
        foreach ($technologies as $technology) {
            Technology::create($technology);
        }
    }
}
