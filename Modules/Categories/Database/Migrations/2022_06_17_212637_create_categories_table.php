<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use \App\Traits\Database\Migration;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->json('name');
            $table->string('slug');
            $table->boolean('online')->default(true);
            $table->integer('position')->unsigned()->nullable();
            $table->string('type')->default('area');
            $table->unsignedBigInteger('parent_id')->nullable()->index();

            $this->addSeoFields($table);

            $table->softDeletes();
            $table->timestamps();

            // Indexes
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
