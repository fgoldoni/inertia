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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('filename')->nullable();
            $table->string('disk')->default('upload');
            $table->string('mime_type')->nullable();
            $table->string('size')->nullable();

            $table->foreignId('user_id')->nullable()->unsigned()->index()->references('id')->on('users')->onDelete('cascade');
            $table->nullableMorphs('attachable');

            $table->softDeletes();
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
        Schema::dropIfExists('attachments');
    }
};
