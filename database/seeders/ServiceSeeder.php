<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'holder_id' => null,
            'nome' => 'Agenzia Assicurazioni',
        ]);

        Service::create([
            'holder_id' => null,
            'nome' => 'Corsi di formazione',
        ]);

        Service::create([
            'holder_id' => null,
            'nome' => 'Patronato',
        ]);
    }
}
