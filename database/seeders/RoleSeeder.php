<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                'name' => 'superuser', 
                'is_active' => 1, 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('roles')->insert(
            [
                'name' => 'admin', 
                'is_active' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('roles')->insert(
            [
                'name' => 'ketum', 
                'is_active' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('roles')->insert(
            [
                'name' => 'waketum', 
                'is_active' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('roles')->insert(
            [
                'name' => 'humas',
                'is_active' => 1, 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('roles')->insert(
            [
                'name' => 'bendahara',
                'is_active' => 1, 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('roles')->insert(
            [
                'name' => 'konsumsi', 
                'is_active' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('roles')->insert(
            [
                'name' => 'dakwah', 
                'is_active' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('roles')->insert(
            [
                'name' => 'tarbiyah', 
                'is_active' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('roles')->insert(
            [
                'name' => 'litbang', 
                'is_active' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        ); 

        DB::table('roles')->insert(
            [
                'name' => 'marbot', 
                'is_active' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        ); 

        DB::table('roles')->insert(
            [
                'name' => 'muadzin', 
                'is_active' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        ); 

        DB::table('roles')->insert(
            [
                'name' => 'jamaah', 
                'is_active' => 1,
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        ); 
    }
}
