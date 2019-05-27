<?php

namespace App\Console\Commands;

use App\Models\Location;
use Illuminate\Console\Command;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\GuzzleException;
use App\Console\Commands\Exceptions\InvalidResponseException;

class GetLocationLongitudeLatitude extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:locationLngLat {--key=AIzaSyDSKsq6R1oOIuorMPaRtNGTCYkt8HzgpSs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command tries to generate longitude and latitude for the locations table.';

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

        // Initialize the guzzle client.
        $this->client = new Guzzle([
            'base_uri' => 'https://maps.googleapis.com/maps/api/'
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $locations = Location::all();

        $bar = $this->output->createProgressBar(count($locations));

        $bar->start();

        $successful = 0;

        foreach ($locations as $location) {
            try
            {
                $l = "{$location->name}, {$location->state->name}";

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

                $location->longitude = $googleLocation->lng;

                $location->latitude = $googleLocation->lat;

                $location->save();

                $this->comment(PHP_EOL . "Gotten the longitude and latitude of $location->name" . PHP_EOL);

            }
            catch (GuzzleException $e)
            {
                $this->error(PHP_EOL . 'Failed to get the longitude and latitude for Location "' .  $location->id . '" because -> "' . $e->getMessage() .'"' . PHP_EOL);
            }
            catch (\Exception $e)
            {
                $this->error(PHP_EOL . 'Failed to get the longitude and latitude for Location "' .  $location->id . '" because -> "' . $e->getMessage() .'"' . PHP_EOL);
            }

            $successful += 1;

            $bar->advance();
        }
        $bar->finish();

        $this->info(PHP_EOL . 'Successfully found the longitude and latitude of ' . $successful . ' locations' . PHP_EOL);
    }
}
