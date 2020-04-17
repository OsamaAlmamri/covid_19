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
         $this->call(CustomerTableSeeder::class);
    }
}
//composer dump-autoload
//
//php artisan db:seed
//
//php artisan db:seed --class=CustomerTableSeeder
