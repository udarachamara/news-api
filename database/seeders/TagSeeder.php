<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTagsForEnglish(env('DB_CONNECTION_ENGLISH'));
        $this->createTagsForSinhala(env('DB_CONNECTION_SINHALA'));
    }

    public function createTagsForEnglish($connection)
    {
        $tags = ['Local', 'Politics', 'Overseas', 'Sports', 'Whether', 'Headline', 'Top News'];

        foreach ($tags as $key => $value) {
            \App\Models\Tag::factory()->connection($connection)->create([
                'name' => $value
            ]);
        }
    }

    public function createTagsForSinhala($connection)
    {
        $tags = ['දේශීය පුවත්', 'ප්‍රධාන පුවත', 'රට වටා', 'ලෝකය', 'ක්‍රීඩා පුවත්', 'විශේෂාංග'];

        foreach ($tags as $key => $value) {
            \App\Models\Tag::factory()->connection($connection)->create([
                'name' => $value
            ]);
        }
    }
}
