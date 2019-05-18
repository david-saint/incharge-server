<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class GenerateCountries extends Command
{

    /**
     * The api to ge the local government and states from.
     * 
     * @var string
     */
    protected $api = 'http://vocab.nic.in/rest.php/country/json';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:countries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Countries';

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
        $content = json_decode(file_get_contents($this->api));

        $countries = $content->countries;

        $bar = $this->output->createProgressBar(count($countries));

        foreach ($countries as $key => $value) {
            $this->line(' Creating country with country code ' . $value->country->country_id);

            Country::create([
                'code'  =>  $value->country->country_id,
                'name'  =>  $value->country->country_name,
            ]);

            $bar->advance();
        }

        $bar->finish();

        $this->info('Done');

        $this->info('Successfully created ' . count($countries) . ' countries.');
    }
}
