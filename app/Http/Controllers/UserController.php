<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPost;
use App\Http\Requests\UpdateUserPut;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $users = User::query()->orderBy('id');
        $search = "";
        if (request()->has("search")) {
            $search = request("search");
            $users = $users->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }
        $users = $users->paginate(10);

        return Inertia::render('User/Index', [
            'users' => $users,
            'search' => $search,
            'time' => now()->toTimeString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('User/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserPost $request)
    {
        User::create($request->validated());
        return Redirect::route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Inertia\Response
     */
    public function show(User $user)
    {
        $userSelect = $user;
        return Inertia::render('User/Show', compact('userSelect'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Inertia\Response
     */
    public function edit(User $user)
    {
        $userSelect = $user;
        return Inertia::render('User/Edit', compact('userSelect'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserPut $request, User $user)
    {
        $userSelect = $user;
        $userSelect->update($request->validated());
//        return Inertia::render('User/Show',compact('userSelect'));
        return Redirect::route('user.index', compact('userSelect'));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $userSelect = $user;
        $userSelect->delete();
        return Redirect::route('user.index');
    }
}
