<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->randomDate();
        return [
            'user_id' => User::all()->random()->id,
            'status' => ['Done','Pending','Cancel'][array_rand(['Done','Pending','Cancel'])],
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }

    function randomDate()
    {
        $start_date = date('Y-m-01');
        $end_date  = date("Y-m-d");

        $min = strtotime($start_date);
        $max = strtotime($end_date);

        $val = rand($min, $max);

        return date('Y-m-d H:i:s', $val);
    }
}
