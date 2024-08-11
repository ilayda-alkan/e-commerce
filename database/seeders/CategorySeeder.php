<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(array(
            'title' => 'Tecnology',
            'description' => 'useful',
            'status'=> True
        ));
    }
}
