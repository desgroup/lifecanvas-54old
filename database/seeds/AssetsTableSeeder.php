<?php

use Illuminate\Database\Seeder;

class AssetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Asset::class, 1)->create();
    }
}
