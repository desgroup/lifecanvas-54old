<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Byte;
use App\Line;

class ByteLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $byteId = Byte::pluck('id')->toArray();
        $lineId = Line::pluck('id')->toArray();

        foreach (range(1, 100) as $index) {
            DB::table('byte_line')->insert([
                'byte_id' => $faker->randomElement($byteId),
                'line_id' => $faker->randomElement($lineId)
            ]);
        }
    }
}
