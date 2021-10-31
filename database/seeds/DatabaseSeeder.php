<?php

use App\Models\City;
use App\Models\User;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Restaurant;
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

        $users = factory('App\Models\User', 500)->create();
        foreach ($users as $user) {
            $user->assignRole('customer');
        }

        //create categories
        $Breakfast = Category::create(['name' => 'Breakfast']);
        $Oriantel = Category::create(['name' => 'Oriantel']);
        $Fast_Food = Category::create(['name' => 'Fast Food']);

        //create Restaurant
        // restaurant names 
        $restaurants = ['MAC','EL za3eem','Oriantal','KFC','Momen','paradise','Maxim','Pizza Hut','Dominos Pizza'];
        foreach ($restaurants as $restaurantName) {
            $restaurant = Restaurant::create([
                'name'          =>  $restaurantName,
                'opening_time'  =>  '10:00:00',
                'closing_time'  =>  '23:00:00',
                'main_number'   =>  '692',
                'picture'       =>  '1623934962_aa.PNG',
                'price_range'   =>  '2',
                'type'          =>  'Restaurant',
            ]);
            $category_ids = [];
            $category_ids[] = Category::all()->random()->id;
            $category_ids[] = Category::all()->random()->id;

            $restaurant->categories()->sync($category_ids);
        }

        $branches_json = File::get("database/data/branches.json");
        $branchesData = json_decode($branches_json);
        foreach ($branchesData as $obj) {
            $branch = Branch::create(array(
                'restaurant_id' =>  Restaurant::all()->random()->id,
                'lat'           =>  $obj->latitude,
                'lng'           =>  $obj->longitude,
                'address'       =>  'address test',
                'city_id'       =>  City::all()->random()->id,
            ));
            if ($branch->id == 20000) {
                break;
            }
        }
        // $categories = [$Breakfast->id, $Fast_Food->id];
        // $MAC->categories()->attach($categories);

        // add branchs to mac 
        // $branch1 = Branch::create([
        //     'restaurant_id' =>  $MAC->id,
        //     'lat'           =>  '30.141945946519552',
        //     'lng'           =>  '31.342200015846924',
        //     'address'       =>  'Voluptatem duis repr',
        //     'city_id'       =>  1,
        // ]);
    }
}
