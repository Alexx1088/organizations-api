<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Building;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      //   \App\Models\User::factory(5)->create();

        $buildings = Building::factory()
            ->count(5)
            ->create();

        $buildings->each(function ($building) {
            Organization::factory()
                ->count(3)
                ->create([
                    'building_id' => $building->id,
                ]);
        });

    }
}
