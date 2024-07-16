<?php

namespace Database\Factories;

use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShortUrlVisit>
 */
class MyShortUrlVisitFactory extends Factory
{
    protected $model = ShortURLVisit::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $thisYear = $this->faker->dateTimeThisYear();
        return [
            'ip_address' => $this->faker->ipv4(),
            'operating_system' => $this->faker->randomElement([
                'OS X',
                'iOS',
                'Android',
                'null',
            ]),
            'operating_system_version' => $this->faker->randomFloat(8, 20),
            'browser' => $this->faker->randomElement([
                'Firefox',
                'Safari',
                'Chrome',
                'Googlebot',
            ]),
            'browser_version' => $this->faker->randomFloat(8, 20),
            'device_type' => $this->faker->randomElement([
                'desktop',
                'mobile',
                'tablet',
                'robot',
            ]),
            'visited_at' => $thisYear,
            'referer_url' => $this->faker->url(),
            'created_at' => $thisYear,
            'updated_at' => $thisYear,
        ];
    }
}
