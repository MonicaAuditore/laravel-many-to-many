<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Category;

// Helpers
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'html',
            'css',
            'javascript', 
            'vue',
            'laravel'
        ];

        foreach ($categories as $category) {
            $newCategory = Category::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
