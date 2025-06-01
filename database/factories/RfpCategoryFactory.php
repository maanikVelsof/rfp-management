<?php

namespace Database\Factories;

use App\Models\RfpCategory;  // Ensure this points to App\Models\RfpCategory
use Illuminate\Database\Eloquent\Factories\Factory;

class RfpCategoryFactory extends Factory
{
    protected $model = RfpCategory::class;  // Correct model reference

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'status' => $this->faker->randomElement([0, 1]),
        ];
    }
}