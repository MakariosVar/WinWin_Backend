<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\forms\UserForm;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('points', 'desc')->get();
        $usersCounter = $users->count();

        return view('users.index', compact('users', 'usersCounter')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();

        $userForm = new UserForm($user);
        if ($userForm->loadAndValidate($request) && $userForm->save()) {
            return $this->index();
        }
        $errors = $userForm->errors;
        return view('users.create')->withErrors($errors);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (!$user) {
            abort(404); // Offer not found, return a 404 error
        }
        
        return view('users.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        // Redirect to the desired route after deletion (e.g., index or any other route)
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
