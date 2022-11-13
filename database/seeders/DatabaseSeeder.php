<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class, 
            CompanySeeder::class, 
            PeopleSeeder::class, 
            PositionSeeder::class, 
            RoleSeeder::class, 
            RoleUserSeeder::class, 
            TypeSeeder::class, 
            MenuTypeSeeder::class,
        ]);
         
        //\Models\Company::factory(100)->create();
        //\Models\Employee::factory(100)->hasCompany(1)->create();
    }
}
