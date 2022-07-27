<?php

use App\Traits\Database\DisableForeignKeys;
use App\Traits\Database\TruncateTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    use DisableForeignKeys;
    use TruncateTable;
    use \App\Traits\Database\Migration;

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
            $table->string('website')->nullable();
            $table->string('size')->nullable();
            $table->string('founded')->nullable();
            $table->string('location')->nullable();
            $table->boolean('online')->default(true);

            $this->addTeamField($table);

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
