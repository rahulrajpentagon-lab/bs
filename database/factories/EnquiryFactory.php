<?php

namespace Database\Factories;

use App\Enums\EnquiryStatus;
use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enquiry>
 */
class EnquiryFactory extends Factory
{
    protected $model = Enquiry::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->optional()->numerify('+91 98### #####'),
            'company' => fake()->company(),
            'subject' => fake()->optional()->sentence(4),
            'service' => fake()->randomElement([
                'Business Website',
                'Web Application',
                'Mobile App',
                'SEO',
                'Maintenance',
                'E-commerce Application',
            ]),
            'message' => fake()->paragraph(),
            'status' => EnquiryStatus::New,
            'admin_notes' => null,
        ];
    }
}
