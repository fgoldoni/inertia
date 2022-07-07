<?php


use Modules\Teams\Http\Controllers\AssetsTeamsController;
use Modules\Teams\Http\Controllers\TeamInvitationController;
use Modules\Teams\Http\Controllers\TeamMemberController;
use Modules\Teams\Http\Controllers\TeamsController;

Route::prefix('admin')->middleware(['auth', 'verified', 'permission:browse_teams'])->as('admin.')->group(function () {
    Route::resource('teams', TeamsController::class)->except([ 'destroy' ]);
    Route::delete('teams/{selected}', [TeamsController::class, 'destroy'])->name('teams.destroy');
    Route::put('teams/{id}/restore', [TeamsController::class, 'restore'])->name('teams.restore');

    Route::post('/teams/{team}/members', [TeamMemberController::class, 'store'])->name('teams.members.store');
    Route::delete(
        '/teams/{team}/members/{user}',
        [TeamMemberController::class, 'destroy']
    )->name('teams.members.destroy');

    Route::delete('/teams/invitations/{invitation}', [TeamInvitationController::class, 'destroy'])
        ->name('teams.invitations.destroy');


    Route::put('/teams/assets/{team}', [AssetsTeamsController::class, 'update'])
        ->name('teams.assets.update');
});
