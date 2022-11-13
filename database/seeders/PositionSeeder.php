<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert(
            [
                'name' => 'superuser', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('positions')->insert(
            [
                'name' => 'admin', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('positions')->insert(
            [
                'name' => 'ketum', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('positions')->insert(
            [
                'name' => 'waketum', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('positions')->insert(
            [
                'name' => 'humas', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('positions')->insert(
            [
                'name' => 'bendahara', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('positions')->insert(
            [
                'name' => 'konsumsi', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('positions')->insert(
            [
                'name' => 'konsumsi', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('positions')->insert(
            [
                'name' => 'tarbiyah', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        );

        DB::table('positions')->insert(
            [
                'name' => 'litbang', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        ); 

        DB::table('positions')->insert(
            [
                'name' => 'marbot', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        ); 

        DB::table('positions')->insert(
            [
                'name' => 'muadzin', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        ); 

        DB::table('positions')->insert(
            [
                'name' => 'jamaah', 
                'created_at'=> date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
            ] 
        ); 
    }
}
