<?php

use App\Models\User;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $gov_json = File::get("database/data/governorates.json");
        $govdata = json_decode($gov_json);
        foreach ($govdata as $obj) {
            Governorate::create(array(
                'governorate_name_ar'   =>  $obj->governorate_name_ar,
                'governorate_name_en'   =>  $obj->governorate_name_en,
            ));
        }

        $city_json = File::get("database/data/cities.json");
        $city_data = json_decode($city_json);
        foreach ($city_data as $obj) {
            City::create(array(
                'governorate_id' =>  $obj->governorate_id,
                'city_name_ar'   =>  $obj->city_name_ar,
                'city_name_en'   =>  $obj->city_name_en,
            ));
        }

        //create roles
        Role::create(['name' => 'Super Admin']);
        $admin      = Role::create(['name' => 'admin']);
        $supplier   = Role::create(['name' => 'supplier']);
        $customer   = Role::create(['name' => 'customer']);

        //create users
        $superadmin = User::create([
            'name'              => 'monsef Admin',
            'email'             => 'monsef@gmail.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$Tz8KW1vWlv6yyyBSFNnZLup0H3om2N24BvAR29sGSeQT5XmX8MbFK', // 123456789
        ]);

        $superadmin->assignRole('Super Admin');
        // $userteacher->assignRole('teacher');
        // $userstudent->assignRole('student');
    }
}
