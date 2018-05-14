<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CampsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('camps')->insert([
            'shortcode' => 'lei1807',
            'city' => 'Leipzig',
            'max' => '0',
            'from' => '2018-07-12',
            'to' => '2018-07-15',
            'registration_start' => '2018-06-01',
            'registration_end' => '2018-07-01',
            'url' => '#',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('camps')->insert([
            'shortcode' => 'bon1807',
            'city' => 'Bonn',
            'max' => '80',
            'from' => '2018-07-27',
            'to' => '2018-07-29',
            'registration_start' => '2018-06-01',
            'registration_end' => '2018-07-01',
            'url' => '#',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

}
}
