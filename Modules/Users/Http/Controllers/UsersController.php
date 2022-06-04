<?php
namespace Modules\Users\Http\Controllers;

use App\Repositories\Criteria\WhereLike;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Users\Repositories\Contracts\UsersRepository;

class UsersController extends Controller
{
    public function __construct(private readonly UsersRepository $usersRepository)
    {
    }

    public function index(Request $request)
    {
        info($request->get('perPage'));
        return Inertia::render('Modules/Users/Index', [
            'filters' => $request->only(['search', 'perPage']),
            'users' => $this->usersRepository->withCriteria([
                new WhereLike(['users.id', 'users.name', 'users.email'], $request->get('search'))
            ])->paginate()
                ->withQueryString()
                ->through(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
