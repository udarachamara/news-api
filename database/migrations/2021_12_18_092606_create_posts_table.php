<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::connection('mysql_english')->create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->binary('image')->nullable();
            $table->integer('author_id');
            $table->text('tag_id');
            $table->integer('views')->default(0);
            $table->integer('like')->default(0);
            $table->integer('dislike')->default(0);
            $table->enum('disabled', ['t', 'f']);
            $table->timestamps();
        });

        Schema::connection('mysql_sinhala')->create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->binary('image')->nullable();
            $table->integer('author_id');
            $table->text('tag_id');
            $table->integer('views')->default(0);
            $table->integer('like')->default(0);
            $table->integer('dislike')->default(0);
            $table->enum('disabled', ['t', 'f']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_english')->dropIfExists('posts');
        Schema::connection('mysql_sinhala')->dropIfExists('posts');
    }
}
