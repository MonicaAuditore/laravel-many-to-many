<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Technology;

// Helpers
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Technologies = [
            'html',
            'css',
            'javascript', 
            'vue',
            'laravel'
        ];

        foreach ($Technologies as $technology) {
            $newTechnology = Technology::create([
                'name' => $technology,
                'slug' => Str::slug($technology),
            ]);
        }
    }
}
