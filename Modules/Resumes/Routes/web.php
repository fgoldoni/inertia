<?php
use Modules\Resumes\Http\Controllers\ResumesController;

Route::prefix('admin')->middleware(['auth', 'verified', 'permission:browse_resumes'])->as('admin.')->group(function () {
    Route::resource('resumes', ResumesController::class)->except(['destroy']);
    Route::delete('resumes/{selected}', (new ResumesController())->destroy(...))->name('resumes.destroy');
    Route::put('resumes/{id}/restore', [ResumesController::class, 'restore'])->name('resumes.restore');
});
