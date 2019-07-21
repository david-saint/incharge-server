<?php

use App\Models\FaqGroup;
use Illuminate\Database\Seeder;

class FaqGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FaqGroup::truncate();
        
        FaqGroup::create(['name' => 'Barrier Method']);
        FaqGroup::create(['name' => 'Combined Oral Contraceptives']);
        FaqGroup::create(['name' => 'Diaphragms and Spermicides']);
        FaqGroup::create(['name' => 'Emergency Contraceptive Pills']);
        FaqGroup::create(['name' => 'Female Sterilization']);
        FaqGroup::create(['name' => 'Fertility Awareness']);
        FaqGroup::create(['name' => 'Implants']);
        FaqGroup::create(['name' => 'Injectables']);
        FaqGroup::create(['name' => 'IUCD']);
        FaqGroup::create(['name' => 'Lactational Amenorrhea']);
        FaqGroup::create(['name' => 'Progestin Only Pills']);
        FaqGroup::create(['name' => 'STIs']);
        FaqGroup::create(['name' => 'Vasectomy']);
    }
}
