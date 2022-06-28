<?php

use App\Traits\Database\DisableForeignKeys;
use App\Traits\Database\TruncateTable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    use DisableForeignKeys, TruncateTable;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('dashboard_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->index()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('dashboard_id')->unsigned()->index()->references('id')->on('dashboards')->onDelete('cascade');
            $table->smallInteger('x');
            $table->smallInteger('y');
            $table->smallInteger('w');
            $table->smallInteger('h');
            $table->string('component');

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

        Schema::dropIfExists('dashboards');
        Schema::dropIfExists('dashboard_user');

        $this->enableForeignKeys();
    }
};
