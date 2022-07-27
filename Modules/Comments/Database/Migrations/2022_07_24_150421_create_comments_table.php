<?php

use App\Traits\Database\DisableForeignKeys;
use App\Traits\Database\TruncateTable;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->longText('content')->nullable();
            $table->morphs('commentable');
            $table->integer('reply')->default(0);
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

        Schema::dropIfExists('comments');

        $this->enableForeignKeys();
    }
};
