<?php
namespace App\Traits\Database;

use Illuminate\Database\Schema\Blueprint;

trait Migration
{
    /**
     * Create fields common to all tables.
     */
    public function addCommonFields(Blueprint $table, bool $hasSoftDelete = false): void
    {
        $table->id();
        $table->timestamps();

        if ($hasSoftDelete) {
            $table->softDeletes();
        }
    }

    /**
     * Create fields common to seo.
     */
    public function addSeoFields(Blueprint $table): void
    {
        $table->string('seo_title', 60)->nullable();
        $table->string('seo_description', 160)->nullable();
    }
}
