<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'info@example.com',
            'password' => bcrypt('welcome'),
            'role' => 'owner',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('property_surroundings')->insert(['name' => 'at_edge_of_wood']);
        DB::table('property_surroundings')->insert(['name' => 'by_water']);
        DB::table('property_surroundings')->insert(['name' => 'in_center']);
        DB::table('property_surroundings')->insert(['name' => 'in_green_area']);
        DB::table('property_surroundings')->insert(['name' => 'in_residential_district']);
        DB::table('property_surroundings')->insert(['name' => 'on_busy_road']);
        DB::table('property_surroundings')->insert(['name' => 'on_navigable_waterway']);
        DB::table('property_surroundings')->insert(['name' => 'on_quiet_road']);
        DB::table('property_surroundings')->insert(['name' => 'open_position']);
        DB::table('property_surroundings')->insert(['name' => 'outside_built_up_area']);
        DB::table('property_surroundings')->insert(['name' => 'overlooking_park']);
        DB::table('property_surroundings')->insert(['name' => 'rural']);
        DB::table('property_surroundings')->insert(['name' => 'sheltered_position']);
        DB::table('property_surroundings')->insert(['name' => 'unobstructed_view']);

        DB::table('property_features')->insert(['name' => 'airconditioning']);
        DB::table('property_features')->insert(['name' => 'balcony']);
        DB::table('property_features')->insert(['name' => 'bathtub']);
        DB::table('property_features')->insert(['name' => 'bathtub_shower']);
        DB::table('property_features')->insert(['name' => 'calorimeters']);
        DB::table('property_features')->insert(['name' => 'central_heating_boiler']);
        DB::table('property_features')->insert(['name' => 'central_heating_boiler_gaz']);
        DB::table('property_features')->insert(['name' => 'central_heating_boiler_fuel']);
        DB::table('property_features')->insert(['name' => 'central_heating_boiler_electric']);
        DB::table('property_features')->insert(['name' => 'central_heating_pump']);
        DB::table('property_features')->insert(['name' => 'commercial_space']);
        DB::table('property_features')->insert(['name' => 'elevator']);
        DB::table('property_features')->insert(['name' => 'fixer_upper']);
        DB::table('property_features')->insert(['name' => 'jacuzzi']);
        DB::table('property_features')->insert(['name' => 'monumental_building']);
        DB::table('property_features')->insert(['name' => 'open_fireplace']);
        DB::table('property_features')->insert(['name' => 'open_fireplace_K7']);
        DB::table('property_features')->insert(['name' => 'renewable_energy']);
        DB::table('property_features')->insert(['name' => 'renewable_energy_sun_panels']);
        DB::table('property_features')->insert(['name' => 'eletricity_day_night']);
        DB::table('property_features')->insert(['name' => 'sauna']);
        DB::table('property_features')->insert(['name' => 'shed_storage']);
        DB::table('property_features')->insert(['name' => 'steam_cabin']);
        DB::table('property_features')->insert(['name' => 'swimming_pool']);
        DB::table('property_features')->insert(['name' => 'swimming_pool_heated']);
        DB::table('property_features')->insert(['name' => 'swimming_pool_covered']);
        DB::table('property_features')->insert(['name' => 'swimming_pool_in_house']);

        DB::table('property_garages')->insert(['name' => 'garage']);
        DB::table('property_garages')->insert(['name' => 'lean_to']);
        DB::table('property_garages')->insert(['name' => 'lock_up_garage']);
        DB::table('property_garages')->insert(['name' => 'garage_carport']);
        DB::table('property_garages')->insert(['name' => 'built_in']);
        DB::table('property_garages')->insert(['name' => 'underground_car_park']);
        DB::table('property_garages')->insert(['name' => 'basement']);
        DB::table('property_garages')->insert(['name' => 'detached']);

    }
}
