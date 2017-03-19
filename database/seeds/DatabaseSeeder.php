<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * List of tables impacted by the seeder. These will be truncated first.
     * @var array
     */
    private $tables;

    /**
     * DatabaseSeeder constructor.
     * @param ByteTransformer $byteTransformer
     * @internal param ByteTransformer $lessonTransformer
     */
    function __construct()
    {
        $this->tables = [
            'timezones',
            'countries'
        ];

        if(getenv('APP_ENV') == "local")
        {
            array_push($this->tables,
                'users',
                'bytes',
                'places',
                'lines',
                'people',
                'byte_person',
                'byte_line'
                //'assets'
            );
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateDatabase();

        $this->call(TimezonesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);

        if(getenv('APP_ENV') == "local") {
            $this->call(UsersTableSeeder::class);
            $this->call(BytesTableSeeder::class);
            $this->call(PlacesTableSeeder::class);
            $this->call(LinesTableSeeder::class);
            $this->call(PeopleTableSeeder::class);
            $this->call(ByteLineSeeder::class);
            $this->call(BytePeopleSeeder::class);
            //$this->call(AssetsTableSeeder::class);
        }
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
