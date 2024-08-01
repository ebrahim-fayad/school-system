<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Gender;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Specialization;
use App\Models\TypeBlood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Nationality::truncate();
        TypeBlood::truncate();
        Religion::truncate();
        Nationality::truncate();
        Gender::truncate();
        Specialization::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->call([
            TypeBloodSeeder::class,
            NationalitySeeder::class,
            ReligionSeeder::class,
            GenderSeeder::class,
            SpecializationSeeder::class,
        ]);
    }
}
