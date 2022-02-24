<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Modules\Xot\Models\Image;

class ImageFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
       

        return [
            'src' => $this->faker->word,
            'width' => $this->faker->randomNumber,
            'height' => $this->faker->randomNumber,
            'src_out' => $this->faker->text
        ];
    }
}