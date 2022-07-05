<?php


use Modules\Teams\Http\Controllers\TeamsController;

Route::prefix('admin')->middleware(['auth', 'verified', 'permission:browse_teams'])->as('admin.')->group(function () {
    Route::resource('teams', TeamsController::class)->except([ 'destroy' ]);
    Route::delete('teams/{selected}', [TeamsController::class, 'destroy'])->name('teams.destroy');
    Route::put('teams/{id}/restore', [TeamsController::class, 'restore'])->name('teams.restore');
});
