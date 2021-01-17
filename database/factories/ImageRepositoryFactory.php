<?php

namespace Database\Factories;

use App\Models\ImageRepository;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageRepositoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImageRepository::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Default Repository'
        ];
    }
}
