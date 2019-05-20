<?php

namespace App\Console\Commands;

use App\Models\State;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class GenerateStatesAndLGA extends Command
{

    /**
     * The api to ge the local government and states from.
     * 
     * @var string
     */
    protected $api = 'http://locationsng-api.herokuapp.com/api/v1/lgas';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate States and Locations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        Model::unguard();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $states = json_decode(file_get_contents($this->api));

        $lgaCount = 0;

        $bar = $this->output->createProgressBar(count($states));

        foreach ($states as $state) {
            $lcount = count($state->lgas);

            $this->comment("Creating $state->state with $lcount LGAs");

            State::create(['name'=> $state->state])->locations()->createMany(array_map(function($lga){
                return [ 'name' => $lga, 'country_id' => 162 ];
            }, $state->lgas));

            $bar->advance();

            $lgaCount += $lcount;
        }

        $this->info('Done');

        $this->info("Created ".count($states)." states");

        $this->info("Created ".$lgaCount." LGA's");
    }
}
