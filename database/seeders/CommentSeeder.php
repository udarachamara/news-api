<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Comment::factory()->create();
        \App\Models\Comment::factory()->create();
        \App\Models\Comment::factory()->create();
        \App\Models\Comment::factory()->create();
        \App\Models\Comment::factory()->create();
    }
}
