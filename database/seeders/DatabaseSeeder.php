<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Section;
use App\Models\Specialization;
use App\Models\Student;
use App\Models\TypeBlood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Class_;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(1)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Nationality::truncate();
        TypeBlood::truncate();
        Religion::truncate();
        Nationality::truncate();
        Gender::truncate();
        Grade::truncate();
        Classroom::truncate();
        Specialization::truncate();
        Section::truncate();
        MyParent::truncate();
        Student::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->call([
            TypeBloodSeeder::class,
            NationalitySeeder::class,
            ReligionSeeder::class,
            GenderSeeder::class,
            SpecializationSeeder::class,
            GradeSeeder::class,
            ClassroomSeeder::class,
            SectionSeeder::class,
            ParentsSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
