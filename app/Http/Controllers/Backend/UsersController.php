<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name')->paginate($this->limit);
        $usersCount = User::count();

        return view("backend.users.index", compact('users', 'usersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view("backend.users.create", compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\UserStoreRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserStoreRequest $request)
    {
        $user = User::create($request->all());
        $user->attachRole($request->role);

        return redirect("/backend/users")->with("message", "New user was created successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view("backend.users.edit", compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\UserUpdateRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        $user->detachRoles();
        $user->attachRole($request->role);

        return redirect("/backend/users")->with("message", "User was updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Requests\UserDestroyRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requests\UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);

        $deleteOption = $request->delete_option;
        $selectedUser = $request->selected_user;

        if ($deleteOption == "delete") {
            // delete user posts
            $user->posts()->withTrashed()->forceDelete();
        } elseif ($deleteOption == "attribute") {
            $user->posts()->update(['author_id' => $selectedUser]);
        }

        $user->delete();

        return redirect("/backend/users")->with("message", "User was deleted successfully!");
    }

    /**
     * @param Requests\UserDestroyRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(Requests\UserDestroyRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $users = User::where('id', '!=', $user->id)->pluck('name', 'id');

        return view("backend.users.confirm", compact('user', 'users'));
    }
}
