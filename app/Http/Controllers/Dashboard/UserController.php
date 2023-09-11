<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::with('division')->get();
        $title = 'Data Employees';
        return view('dashboard.user.index', compact(['users', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {   
        $divisions = Division::all();
        $title = 'Add Employee';
        return view('dashboard.user.create', compact(['divisions', 'title']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {  
        $data = $request->all();
        $data['email_verified_at'] = now();
        $data['password'] = Hash::make($request['password']);
        $data['remember_token'] = Str::random(10);

        // dd($data);
        User::create($data);
        return redirect()->route('users.index')->with('success', 'Data user has been inserted successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $divisions = Division::all();
        $title = 'Edit Profile';
        return view('dashboard.user.edit', compact(['user', 'divisions', 'title']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {   
        $data = $request->validated();
        $user_name = $user->name;

        if($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', $user_name . ' profile has been udpated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);
        $user_name = $user->name;
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Data ' . $user_name . ' has been deleted successfully');
    }
}