<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Statistic::firstOrCreate(['id' => 1], [
            'years_of_experience' => 10,
            'clients_count' => 250,
            'projects_count' => 180,
        ]);
    }
}
