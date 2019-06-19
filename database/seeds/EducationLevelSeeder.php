<?php

use App\Models\EducationLevel;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EducationLevel::truncate();

        EducationLevel::create(['name' => 'BArch']);
        EducationLevel::create(['name' => 'BA']);
        EducationLevel::create(['name' => 'B.Sc']);
        EducationLevel::create(['name' => 'B.ENG']);
        EducationLevel::create(['name' => 'LLB']);
        EducationLevel::create(['name' => 'HNC']);
        EducationLevel::create(['name' => 'HND']);
        EducationLevel::create(['name' => 'ND']);
        EducationLevel::create(['name' => 'M.Sc']);
        EducationLevel::create(['name' => 'M.Eng']);
        EducationLevel::create(['name' => 'Phd.']);
        EducationLevel::create(['name' => 'Prof']);
        EducationLevel::create(['name' => 'B.Tech']);
        EducationLevel::create(['name' => 'Other']);
    }
}
