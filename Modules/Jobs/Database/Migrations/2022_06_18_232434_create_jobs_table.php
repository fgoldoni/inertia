<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Jobs\Enums\JobState;
use Modules\Jobs\Enums\SalaryType;

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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            $table->json('name');
            $table->string('slug');
            $table->string('phone')->nullable();
            $table->longText('content')->nullable();
            $table->integer('salary_min')->unsigned()->nullable();
            $table->integer('salary_max')->unsigned()->nullable();
            $table->string('salary_type')->default((SalaryType::Year)->value);
            $table->boolean('negotiable')->default(true);
            $table->string('state')->default((JobState::Draft)->value);
            $table->string('avatar_path', 2048)->nullable();
            $table->smallInteger('open')->default(1);

            $this->addSeoFields($table);

            $this->addTeamField($table);

            $table->foreignId('company_id')->nullable()->index()->references('id')->on('companies')->onDelete('cascade');
            $table->foreignId('user_id')->unsigned()->index()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('country_id')->nullable()->unsigned()->index()->references('id')->on('world_countries')->cascadeOnDelete();
            $table->foreignId('division_id')->nullable()->unsigned()->index()->references('id')->on('world_divisions')->cascadeOnDelete();
            $table->foreignId('city_id')->nullable()->unsigned()->index()->references('id')->on('world_cities')->cascadeOnDelete();
            $table->date('closing_to')->nullable();

            $table->datetime('live_at')->nullable();
            $table->string('address')->nullable();
            $table->string('zip')->nullable();
            $table->text('iframe')->nullable();
            $table->integer('view_count')->default(0);

            $table->softDeletes();
            $table->timestamps();

            $table->unique('slug');
        });

        Schema::create('job_user', function (Blueprint $table) {
            $table->foreignId('user_id')->unsigned()->index()->references('id')->on('users')->onDelete('cascade');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_user');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
