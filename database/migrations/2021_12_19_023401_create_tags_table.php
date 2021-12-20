<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();

        Schema::connection('mysql_english')->create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('disabled', ['t', 'f']);
            $table->timestamps();
        });

        Schema::connection('mysql_sinhala')->create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
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
        Schema::connection('mysql_english')->dropIfExists('tags');
        Schema::connection('mysql_sinhala')->dropIfExists('tags');
    }
}
