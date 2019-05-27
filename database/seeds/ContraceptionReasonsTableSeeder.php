<?php

use Illuminate\Database\Seeder;

class ContraceptionReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\ContraceptionReason::firstOrCreate([ 'value'	=>	'Completed family size' ]);
        \App\Models\ContraceptionReason::firstOrCreate([ 'value'	=>	'Child Spacing' ]);
        \App\Models\ContraceptionReason::firstOrCreate([ 'value'	=>	'Sexually Active with no plan for children at the moment' ]);
    }
}
