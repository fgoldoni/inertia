<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('job_tag', function (Blueprint $table) {
            $table->foreignId('tag_id')->unsigned()->index()->references('id')->on('tags')->onDelete('cascade');
            $table->foreignId('job_id')->unsigned()->index()->references('id')->on('jobs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
    }
};
