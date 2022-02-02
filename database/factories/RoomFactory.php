<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Room;

class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

            $name = $this->faker->name();
            $slug = Str::slug($name);
            $description = $this->faker->realText(200);
            $price = $this->faker->numerify;



        return [
            "name" => $name,
            "slug" => $slug,
//            "category_id" => Category::all()->random()->id,
            "description" => $description,
            "price"  => $price,
            "user_id" => User::all()->random()->id,


        ];
    }
}
