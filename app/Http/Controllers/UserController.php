<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    // Register a new user
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'phone_number' => 'required|string|unique:users',
            'password' => 'required|string'
        ]);

        // Create a new user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
            'role_id' => 6
        ]);

        // Create an auth token for the user
        $authToken = $user->createToken('authToken')->plainTextToken;


        return response()->json([
            'response' => 'success',
            'message' => 'Successfully created user!',
            'user' => $user,
            'authToken' => $authToken
        ], 201);
    }


    //
    // Login a user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // Find the user
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'response' => 'failure',
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Create an auth token for the user
        $authToken = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'response' => 'success',
            'message' => 'Successfully logged in!',
            'user' => $user,
            'authToken' => $authToken
        ], 200);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string'
        ]);

        // Find the user
        $user = User::where('email', $request->user()->email)->first();

        // Check if the user exists and the password is correct
        if (!$user || !Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'response' => 'failure',
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Check if the new password is the same as the old password
        if ($request->old_password == $request->new_password) {
            return response()->json([
                'response' => 'failure',
                'message' => 'New password cannot be the same as the old password'
            ], 401);
        }

        // Change the user's password
        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->json([
            'response' => 'success',
            'message' => 'Successfully changed password!'
        ], 200);
    }


    //
    // Update user avatar
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required',
        ]);

        // Find the user
        $user = User::where('id', $request->user()->id)->first();

        // Check if the user exists
        if (!$user) {
            return response()->json([
                'response' => 'failure',
                'message' => 'User does not exist'
            ], 401);
        }

        // Update the user's avatar
        $user->avatar = $request->avatar;
        $user->save();

        return response()->json([
            'response' => 'success',
            'message' => 'Successfully updated avatar!',
            'user' => $user
        ], 200);
    }
}
