<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\Database\DisableForeignKeys;
use App\Traits\Database\TruncateTable;

return new class() extends Migration {
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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->string('name');
            $table->string('display_name')->nullable();
            $table->string('subdomain')->unique()->nullable();
            $table->boolean('personal_team');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->boolean('online')->nullable();

            $table->string('avatar_path', 2048)->nullable();

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

        Schema::dropIfExists('teams');

        $this->enableForeignKeys();
    }
};
