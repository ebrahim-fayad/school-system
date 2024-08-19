<?php

namespace Database\Seeders;

use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\TypeBlood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ParentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $my_parents = new MyParent();
        $my_parents->email = 'ibrahim.gamal77@yahoo.com';
        $my_parents->password = Hash::make('12345678');
        $my_parents->Name_Father = ['en' => 'Ibrahim Fayad', 'ar' => 'ابراهيم فياض'];
        $my_parents->National_ID_Father = '1234567810';
        $my_parents->Passport_ID_Father = '1234567810';
        $my_parents->Phone_Father = '1234567810';
        $my_parents->Job_Father = ['en' => 'Programmer', 'ar' => 'مبرمج'];
        $my_parents->Nationality_Father_id = Nationality::all()->unique()->random()->id;
        $my_parents->Blood_Type_Father_id = TypeBlood::all()->unique()->random()->id;
        $my_parents->Religion_Father_id = Religion::all()->unique()->random()->id;
        $my_parents->Address_Father = 'القاهرة';
        $my_parents->Name_Mother = ['en' => 'Aya', 'ar' => 'ايه'];
        $my_parents->National_ID_Mother = '1234567810';
        $my_parents->Passport_ID_Mother = '1234567810';
        $my_parents->Phone_Mother = '1234567810';
        $my_parents->Job_Mother = ['en' => 'Doctor', 'ar' => 'طبيبة'];
        $my_parents->Nationality_Mother_id = Nationality::all()->unique()->random()->id;
        $my_parents->Blood_Type_Mother_id = TypeBlood::all()->unique()->random()->id;
        $my_parents->Religion_Mother_id = Religion::all()->unique()->random()->id;
        $my_parents->Address_Mother = 'القاهرة';
        $my_parents->save();
    }
}
