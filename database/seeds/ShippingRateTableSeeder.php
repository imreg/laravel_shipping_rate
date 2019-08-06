<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingRateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds();
    }

    private function seeds()
    {
        $path = database_path('payloads/example.json');
        $array = json_decode(file_get_contents($path), true);
        foreach ($array as $record) {
            DB::table('shipping_rates')->insert($record);
        }
    }
}

