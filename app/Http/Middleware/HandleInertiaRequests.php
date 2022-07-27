<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => fn () => [
                'user' => $request->user() ? [
                    'id' => $request->user()->id,
                    'name' => $request->user()->name,
                    'email' => $request->user()->email,
                    'isAdministrator' => $request->user()->isAdministrator(),
                ] : null,
            ],
            'can' => fn () => $request->user() ? [
                'is_impersonated' => $request->user()->isImpersonated(),
                'access_dashboard' => $request->user()->hasPermissionTo('access_dashboard'),
            ] : null,
            'accessMenu' => fn () => $request->user() ? [
                'access_dashboard' => $request->user()->hasPermissionTo('access_dashboard'),
                'browse_users' => $request->user()->hasPermissionTo('browse_users'),
                'browse_roles' => $request->user()->hasPermissionTo('browse_roles'),
                'browse_teams' => $request->user()->hasPermissionTo('browse_teams'),
                'browse_categories' => $request->user()->hasPermissionTo('browse_categories'),
                'browse_countries' => $request->user()->hasPermissionTo('browse_countries'),
                'browse_companies' => $request->user()->hasPermissionTo('browse_companies'),
                'browse_jobs' => $request->user()->hasPermissionTo('browse_jobs'),
                'browse_resumes' => $request->user()->hasPermissionTo('browse_resumes'),
                'browse_applicants' => $request->user()->hasPermissionTo('browse_applicants'),
                'log_viewer' => $request->user()->hasPermissionTo('log_viewer'),
            ] : null,
            'flash' => fn () => [
                'style' => 'success',
                'message' => $request->session()->get('success'),
            ],
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
