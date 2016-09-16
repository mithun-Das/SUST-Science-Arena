<?php

use Illuminate\Database\Seeder;
use App\Language;
// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class LanguageTableSeeder extends Seeder
{
    public function run()
    {
        Language::create(['name' => 'Laravel 5.1']);
        Language::create(['name' => 'Laravel 4.2']);
    }
}
