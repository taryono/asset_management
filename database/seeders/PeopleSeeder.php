<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class PeopleSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('people')->insert(
            [
                'first_name' => 'Taryono',
                'last_name' => 'Santoso',
                'email' => 'denmas.yono@grtech.com.my',
                'company_id' => 1,
                'phone' => '087883732016', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        ); 
    }
}
