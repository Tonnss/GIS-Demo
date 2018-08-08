<?php

use Illuminate\Database\Seeder;
use Grimzy\LaravelMysqlSpatial\Types\Point;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('> Seeding Countries...');

        $countryModel = app('App\Countries');
        $countries    = $this->countries();
        if ( $countries )
        {
            foreach ( $countries as $key => $country )
            {
                list($lat, $lang) = $country['latlng'];
                unset($country['latlng'], $country['timezones']);


                $country['position']    = ++$key;
                $country['coordinates'] = new Point($lat, $lang);
                $countryModel->updateOrcreate(['country_code' => $country['country_code']], $country);
            }

            $this->command->info('> Finished Seeding `countries` Table!');
        }
    }

    private function countries()
    {
        $countries_path = storage_path('json/countries.json');
        if ( File::exists($countries_path) )
            return json_decode(File::get($countries_path), true);
        return [];
    }
}
