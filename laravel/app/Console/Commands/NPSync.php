<?php

namespace larashop\Console\Commands;

use Illuminate\Console\Command;


use Symfony\Component\Console\Input\InputOption;
use Illuminate\Http\Request;



use larashop\NPCity;
use larashop\NPUnit;

use Setting;

use NovaPoshta\Config;
use NovaPoshta\ApiModels\Address;



class NPSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    
    protected $signature = 'np:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        //


        Config::setApiKey(Setting::get('integration.np'));
        
        NPCity::truncate();
        $this->info('NP City table cleared');
        NPUnit::truncate();
        $this->info('NP Unit table cleared');



        $unitArr = Address::getWarehouses();

        $this->info('NP unit fetched');

        $adrArr = Address::getCities();
        
        $this->info('NP city fethed');
        
        foreach ($adrArr->data as $value) {
            NPCity::create(['name' => $value->DescriptionRu, 
                            'ref' => $value->Ref]);
        }
        
        $this->info('City table filled.');

        foreach ($unitArr->data as $value) {
            NPUnit::create(['name' => $value->DescriptionRu, 
                            'ref' => $value->CityRef]);
        }

        $this->info('Units table filled');

        $this->info('NP SYNC SUCCESSFULL!');

    }
}
