<?php

namespace App\Console\Commands;

use App\Models\Make;
use App\Models\ModelCar;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateModelsCar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update models';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $makes = Make::all();

        foreach ($makes as $make)
        {
            $modelCar = Http::retry(2, 500)->get("https://vpic.nhtsa.dot.gov/api/vehicles/getmodelsformakeid/{$make->api_make_id}?format=json");

            if(isset($modelCar['Results']) && !empty($modelCar['Results']))
            {
                foreach ($modelCar['Results'] as $car)
                {
                    ModelCar::updateOrCreate(
                        ['model_id' => $car['Model_ID']],
                        [
                            'name' => $car['Model_Name'],
                            'model_id' => $car['Model_ID'],
                            'make_id' => $make->api_make_id,
                        ]);
                }
            }

        }

        return 'Finish update models';
    }

}
