<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(SubjectSeeder::class);
         $this->call(TagSeeder::class);
         $this->call(SubjectTagSeeder::class);
    }
}
