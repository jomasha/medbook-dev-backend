<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('tbl_gender')->insert([
            ['gender_name' => 'Male'],
            ['gender_name' => 'Female'],
            ['gender_name' => 'Others'],
        ]);

        DB::table('tbl_service')->insert([
            ['service_name' => 'Outpatient'],
            ['service_name' => 'Inpatient']
        ]);
    }
}
