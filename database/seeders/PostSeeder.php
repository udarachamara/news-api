<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Post::factory()->connection(env('DB_CONNECTION_ENGLISH'))->create();
        \App\Models\Post::factory()->connection(env('DB_CONNECTION_ENGLISH'))->create();
        \App\Models\Post::factory()->connection(env('DB_CONNECTION_ENGLISH'))->create();
        \App\Models\Post::factory()->connection(env('DB_CONNECTION_ENGLISH'))->create();
        \App\Models\Post::factory()->connection(env('DB_CONNECTION_ENGLISH'))->create();
        \App\Models\Post::factory()->connection(env('DB_CONNECTION_ENGLISH'))->create();
        \App\Models\Post::factory()->connection(env('DB_CONNECTION_ENGLISH'))->create();
        \App\Models\Post::factory()->connection(env('DB_CONNECTION_ENGLISH'))->create();
        \App\Models\Post::factory()->connection(env('DB_CONNECTION_ENGLISH'))->create();
        \App\Models\Post::factory()->connection(env('DB_CONNECTION_ENGLISH'))->create();
    }
}
