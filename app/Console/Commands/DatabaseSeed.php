<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabaseSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:seed
                            {group : The name of the Database seeding group}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run all database seeders for the given group';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->groups = [];

        // Address domain seeders
        $this->groups['address'] = [
            'CountrySeeder',
            'StateSeeder',
            'CountySeeder',
            'CitySeeder',
            'PostalCodeSeeder',
            'AddressSeeder'
        ];

        $this->groups['shop'] = [
            'ShopNameSeeder',
            'ShopSeeder',
            'ManufacturerSeeder',
            'CategorySeeder',
            'ProductSeeder',
            'CurrencySeeder',
            'PriceSeeder',
            'ProductShopSeeder'
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $group = $this->argument('group');
        foreach ($this->groups[$group] as $seeder)
        {
            $this->call('db:seed', ['--class' => $seeder]);
        }
    }
}
