<?php

use App\Shop;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 100; $i++) {
            DB::table('customers')->insert([
                [
                    'name' => 'test' . $i,
                    'phone' => '77777' . $i,
                    'username' => 'test' . $i,
                    'email' => 'test' . $i . '@customer.com',
                    'password' => bcrypt('123'),
                    'code' => '000' . $i,
                    'status' => 1,
                    'truck_number' => '1_00' . $i,
                    'governorate_id' => 2,
                    'zone_id' => 3,
                    'current_location' => 3,
                    'truck_image' => '/images/customers/' . ($i % 10) . '.png',
                    'avatar' => '/images/customers/' . ($i % 10) . '.png',
                    'ssn_image' => '/images/customers/' . ($i % 10) . '.png',
                    'company_id' => (($i % 2) + 1),
                    'truck_id' => (($i % 6) + 1),
                    'created_by' => 1,
                    'maps_address' => 'Triplicane, Chennai, Tamil Nadu, India',
                    'latitude' => '13.05871070',
                    'longitude' => '80.27570630',
                ]
            ]);
        }


    }
}
