<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * List of tables impacted by the seeder. These will be truncated first.
     * @var array
     */
    private $tables = [
        'users',
        'bytes',
        'places',
        'timezones'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateDatabase();

        $this->call(UsersTableSeeder::class);
        $this->call(BytesTableSeeder::class);
        $this->call(PlacesTableSeeder::class);
        $this->call(TimezonesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
    }

    /**
     * Truncates the database tables.
     */
    private function truncateDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $tableName)
        {
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
