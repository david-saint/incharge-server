<?php

namespace App\Console\Commands;

use App\Models\Clinic;
use App\Models\Location;
use App\Helpers\CSVImporter;
use Illuminate\Console\Command;

class GenerateClinics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:clinics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the clinics from the provided csv file.';

    /**
     * The CSVImporter instance that would get the 
     * clinics.
     * 
     * @var [type]
     */
    protected $importer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->importer = new CSVImporter(storage_path('app/application/clinics.csv'), true);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = $this->importer->get();

        $bar = $this->output->createProgressBar(count($data));

        $bar->start();

        $successful = 0;

        foreach ($data as $key => $clinic) {
            try
            {
                $location = Location::where('state_id', 20)->whereRaw("UPPER(`name`) LIKE '%". strtoupper($clinic['lga']) . "%'")->first();

                if ($location) {
                    $clinic = Clinic::create([
                        'added_by_id'   =>  1,
                        'name'          =>  $clinic['name'],
                        'address'       =>  "$location->name, {$location->state->name}"
                    ]);

                    $location->clinics()->save($clinic);

                    $successful += 1;

                } else {
                    $clinic = Clinic::create([
                        'added_by_id'   =>  1,
                        'name'          =>  $clinic['name'],
                        'address'       =>  "{$clinic['lga']}, Oyo State",
                    ]);
                }

                $this->comment(PHP_EOL . 'ADDED CLINIC NAMED ' . $clinic['name'] . ' LOCATED AT ' . $clinic['lga'] . PHP_EOL);
                
            }
            catch (\Exception $e)
            {
                $this->error(PHP_EOL . 'Failed to include clinic ' . $clinic['name'] . ' because ' . $e->getMessage() . PHP_EOL);
            }

            $bar->advance();

        }

        $bar->finish();

        $this->info(PHP_EOL . 'Successfully found location of ' . $successful . ' clinics; out of ' . count($data) . PHP_EOL);
    }
}
