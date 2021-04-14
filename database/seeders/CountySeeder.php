<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\State;

class CountySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $budapest = State::whereName('Budapest')->first();
        $debrecen = State::whereName('Hajdú-Bihar')->first();

        DB::table('counties')->insert([
            [
                'name'      => 'Debreceni Járás',
                'state_id'  => $debrecen->id
            ],
            [
                'name'      => 'Budapest',
                'state_id'  => $budapest->id
            ]
        ]);
    }
}
