<?php

namespace App\Console\Commands;

use App\Models\Make;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateMake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:makes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $all = Http::get('https://vpic.nhtsa.dot.gov/api/vehicles/getallmakes?format=json');

        if(isset($all['Results']))
        {
          foreach ($all['Results'] as $make)
          {
              Make::updateOrCreate(['api_make_id' => $make['Make_ID']], ['name' => $make['Make_Name']]);
          }
        }
       return 'Finish update makes';
    }
}
