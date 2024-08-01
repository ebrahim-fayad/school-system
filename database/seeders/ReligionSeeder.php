<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [

            [
                'en' => 'Muslim',
                'ar' => 'مسلم'
            ],
            [
                'en' => 'Christian',
                'ar' => 'مسيحي'
            ],
            [
                'en' => 'Other',
                'ar' => 'غير ذلك'
            ],

        ];

        foreach ($religions as $R) {
            Religion::create(['Name' => $R]);
        }
    }
}
