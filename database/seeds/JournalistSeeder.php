<?php

use Illuminate\Database\Seeder;

class JournalistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Journalist::class,3)->create();
    }
}
