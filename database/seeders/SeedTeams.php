<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class SeedTeams extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teamNames = [
            'SmartView FC',
            'Hooligans FC',
            'Africa United',
            'Wild Goats',
            'Cornwall United',
            'Berlinger Kickers',
            'Green Cats',
            'Curvy badgers',
            'Compassionate Independents',
            'Brave Monkeys'
        ];

        foreach ($teamNames as $name) {
            Team::firstOrCreate(['name' => $name]);
        }
    }
}
