<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListingSeeder extends Seeder
{
   
      /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'room', 'service', 'event', 'apartment', 'house', 
            'studio', 'transport', 'equipment', 'experience', 'misc'
        ];

        for ($i = 1; $i <= 20; $i++) {
            DB::table('listings')->insert([
                'images' => 'https://via.placeholder.com/400x300?text=Listing+' . $i,
                'title' => 'Sample Listing ' . $i,
                'description' => 'This is a description for listing ' . $i,
                'type' => $types[array_rand($types)],
                'price' => rand(500, 5000),
                'available_from' => Carbon::now()->addDays(rand(0, 30)),
                'available_to' => Carbon::now()->addDays(rand(31, 60)),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
