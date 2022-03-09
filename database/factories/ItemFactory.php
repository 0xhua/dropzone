<?php

namespace Database\Factories;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Item::class;

    public function definition()
    {
        return [

            'date' => Carbon::now(),
            'code' => $this->faker->numerify('###-###-####'),
            'seller_id' => $this->faker->numerify('###'),
            'buyer_id' => $this->faker->numerify('###'),
            'origin' => $this->faker->city,
            'destination' => $this->faker->city,
            'fee' => $this->faker->numberBetween($min = 50, $max = 100),
            'amount' => $this->faker->numberBetween($min = 50, $max = 1000),
            'claimed_date'=> $this->faker->date,
            'release_date' => $this->faker->date,
            'status' => 'claimed',
            'payment_status' => 'paid',
            'approval_status' => 'pending'
        ];
    }
}
