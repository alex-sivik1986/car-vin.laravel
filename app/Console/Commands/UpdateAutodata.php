<?php

namespace App\Console\Commands;

use App\Http\Services\VinDecoderServices as Vincode;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateAutodata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autodata:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update in table model, make, year from vin-code';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $vincode = DB::table('cars')
           ->chunkById(10, function ($cars) {
               foreach ($cars as $car) {
                   DB::table('cars')
                       ->where('id', $car->id)
                       ->update((new Vincode)->decode($car->vin_code));
               }
           });
        dd($vincode);
    }
}
