<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\Deprecated;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->word, 
            'requestor_name' => $this->faker->name,
            'department_id' => DepartmentFactory::new()->create()->id,
            'is_notified' => 0,
            'plan_id' => PlanFactory::new()->create()->id,
            'category_id' => CategoryFactory::new()->create()->id,
            'claim_number' => $this->faker->randomNumber,
            'problem_statement' => $this->faker->sentence,
            'attachment' => $this->faker->imageUrl,
            'target_date' => $this->faker->date,
        ];
    }
}
