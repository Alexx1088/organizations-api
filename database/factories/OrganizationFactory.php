<?php

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'building_id' => Building::factory(),
        ];
    }

    public function hasPhones(int $count = 1): Factory|OrganizationFactory
    {
        return $this->has(\App\Models\Phone::factory()->count($count));
    }
}
