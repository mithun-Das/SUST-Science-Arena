<?php

use Illuminate\Database\Seeder;
use App\Category;
// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Product']);
        Category::create(['name' => 'Client']);
    }
}
