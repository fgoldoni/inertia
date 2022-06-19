<?php

use App\Traits\Database\DisableForeignKeys;
use App\Traits\Database\TruncateTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug');
            $table->longText('content')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->boolean('online')->nullable();

            $table->string('avatar_path', 2048)->nullable();

            $table->foreignId('user_id')->unsigned()->index()->references('id')->on('users')->onDelete('cascade');
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
        $this->disableForeignKeys();

        Schema::dropIfExists('companies');

        $this->enableForeignKeys();
    }
};
