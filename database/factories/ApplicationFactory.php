<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Client;
use App\Models\Company;
use App\Models\Product;
use App\Models\Source;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{


    protected $model = Application::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'number' => $this->faker->unique()->randomNumber(5),
            'link' => $this->faker->url,
            'engine' => $this->faker->randomFloat(1, 10),
            'year' => $this->faker->year,
            'user_id' => function () {
                return User::inRandomOrder()->first()->id;
            },
            'client_id' => function () {
                return Client::inRandomOrder()->first()->id;
            },
            'source_id' => function () {
                return Source::inRandomOrder()->first()->id;
            },
            'status_id' => function () {
                return Status::inRandomOrder()->first()->id;
            },
            'product_id' => function () {
                return Product::inRandomOrder()->first()->id;
            },
            'car_id' => function () {

                return Car::inRandomOrder()->first()->id;
            },
            'car_model_id' => function (array $attributes) {
                // Generate a random car_id
                $carId = Car::inRandomOrder()->first()->id;

                // Check if a CarModel record exists for the random car_id
                $carModel = CarModel::where('car_id', $carId)->inRandomOrder()->first();
                if ($carModel) {
                    return $carId; // Return the random car_id if a CarModel exists
                } else {
                    // If no CarModel record is found, log a message and try again recursively
                    return random_int(1,25); // Try generating a new random car_id
                }
            },
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Application $application) {
            $companyIds = $this->getRandomCompanyIds();
            $this->attachCompaniesToApplication($application, $companyIds);
        });
    }

    private function getRandomCompanyIds($min = 1, $max = 5)
    {
        return Company::inRandomOrder()->limit(rand($min, $max))->pluck('id')->toArray();
    }

    private function attachCompaniesToApplication(Application $application, array $companyIds)
    {
        $application->companies()->attach($companyIds);
    }
}
