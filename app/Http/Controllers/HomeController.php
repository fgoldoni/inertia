<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Criteria\Where;
use Grosv\LaravelPasswordlessLogin\PasswordlessLogin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Modules\Teams\Repositories\Contracts\TeamsRepository;
use Modules\Users\Repositories\Contracts\UsersRepository;

class HomeController extends Controller
{
    public function __construct(
        private readonly UsersRepository $usersRepository,
        private readonly TeamsRepository $teamsRepository
    ) {
    }

    public function index()
    {
        $token = $this->usersRepository->createToken($this->userByEmail('user@user.com'))->plainTextToken;

        $demo = [
            'administrator' => [
                'title' => 'Backend as administrator',
                'url' => $this->adminLink(),
            ],
            'manager' =>  [
                'title' => 'Backend as manager',
                'url' => $this->managerLink(),
            ],

            'netflix' =>  [
                'title' => 'Netflix Job Board',
                'url' => $this->netflixLink($token),
            ],
            'tesla' =>  [
                'title' => 'Tesla Job Board',
                'url' => $this->teslaLink($token),
            ],
            'deutscheBank' =>  [
                'title' => 'Deutsche Bank Job Board',
                'url' => $this->deutscheBankLink($token),
            ],
        ];

        return Inertia::render('Welcome', [
            'demo' => $demo,
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    private function adminLink()
    {
        $admin = $this->userByEmail('admin@admin.com');

        if ($admin->isAdministrator()) {
            return PasswordlessLogin::forUser($admin)->generate();
        }

        return url('/login');
    }

    private function managerLink()
    {
        $manager = $this->userByEmail('manager@manager.com');

        if ($manager->isManager()) {
            return PasswordlessLogin::forUser($manager)->generate();
        }

        return url('/login');
    }

    private function netflixLink(string $token)
    {
        return $this->url($token, 'netflix');
    }

    private function teslaLink(string $token)
    {
        return $this->url($token, 'tesla');
    }

    private function deutscheBankLink(string $token)
    {
        return $this->url($token, 'deutsche-bank');
    }

    private function userByEmail(string $email): User
    {
        return User::with('roles')->where('users.email', $email)->first();
    }

    private function url($token, $subdomain): string
    {
        return  env('FRONTEND_HTTP').$subdomain.env('FRONTEND_DOMAIN').'/token/'.$token;
    }
}
