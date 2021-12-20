<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tags = [];
        $tags[] = $this->faker->numberBetween(1, 5);

        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->text,
            'author_id' => \App\Models\User::factory()->create([
                'role_id' => 3
            ]),
            'tag_id' => json_encode($tags),
            'disabled' => 'f',
        ];
    }
}
