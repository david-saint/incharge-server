<?php

namespace App\Console\Commands;

use App\Models\Clinic;
use App\Models\Location;
use App\Models\Locatable;
use App\Helpers\CSVImporter;
use Illuminate\Console\Command;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\GuzzleException;
use App\Console\Commands\Exceptions\InvalidResponseException;

class GenerateClinics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:clinics {--key=AIzaSyBhATtULNd9DLRc9hbKELEO2HpMG6gC7o0}';

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
     * The Client that would handle the http request
     * to retrieve the longitude and latitude.
     * 
     * @var null
     */
    protected $client = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        // Initialize the CSV importer.
        $this->importer = new CSVImporter(storage_path('app/application/clinics.csv'), true);

        // Initialize the guzzle client.
        $this->client = new Guzzle([ 'base_uri' => 'https://maps.googleapis.com/maps/api/' ]);
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
                    $c = Clinic::create([
                        'added_by_id'   =>  1,
                        'name'          =>  $clinic['name'],
                        'address'       =>  "$location->name, {$location->state->name}"
                    ]);

                    $location->clinics()->save($c);

                    $successful += 1;

                } else {
                    $c = Clinic::create([
                        'added_by_id'   =>  1,
                        'name'          =>  $clinic['name'],
                        'address'       =>  "{$clinic['lga']}, Oyo State",
                    ]);
                }

                $this->comment(PHP_EOL . 'ADDED CLINIC NAMED ' . $clinic['name'] . ' LOCATED AT ' . $clinic['lga'] .  ';' . PHP_EOL);

                $l = "{$c->name}, {$c->address}";

                // Get the longitude and latitude for the specific clinic
                $response = $this->client->request(
                    'GET',
                    'geocode/json',
                    [
                        'query' =>  [
                            'key'       =>  $this->option('key'),
                            'address'   =>  $l,
                        ]
                    ]
                );

                $googleLocation = json_decode($response->getBody());

                if (! isset($googleLocation->results[0]->geometry->location))
                    throw new InvalidResponseException('The reponse doesn\'t have geometry location');

                $googleLocation = $googleLocation->results[0]->geometry->location;

                $c->longitude = $googleLocation->lng;

                $c->latitude = $googleLocation->lat;

                $c->save();

            }
            catch (GuzzleException $e)
            {
                $this->error(PHP_EOL . 'Failed to get the longitude and latitude for "' .  $clinic . '" because -> "' . $e->getMessage() .'"' . PHP_EOL);
            }
            catch (\Exception $e)
            {
                $this->error(PHP_EOL . 'Failed to include clinic ' . $clinic['name'] . ' because ' . $e->getMessage() . PHP_EOL);
                $this->comment($response->getBody());
            }

            $bar->advance();
        }

        $bar->finish();

        $this->info(PHP_EOL . 'Successfully found location of ' . $successful . ' clinics; out of ' . count($data) . PHP_EOL);
    }
}
