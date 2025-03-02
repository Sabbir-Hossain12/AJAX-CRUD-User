<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();

        return view('backend.pages.user.index', compact('users'));
    }


    public function getUserData()
    {
        $users = User::get();

        return DataTables::of($users)
            ->addColumn('action', function ($user) {
                return '<button class="editButton btn btn-primary" data-id="'.$user->id.'" data-bs-toggle="modal" data-bs-target="#editAdminModal">Edit</button>
                                <button class="deleteButton btn btn-danger" data-id="'.$user->id.'" >Delete</button>';
            })
            ->make(true);
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
        $request->validate([

            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],

        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();


        return response()->json(['message' => 'User created successfully'], 201);
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
        $user = User::where('id', $id)->first();


        return response()->json(['message' => 'User edited successfully', 'user' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([

            'name' => ['string'],
            'email' => ['string', 'email'],


        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'User updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
//      $user=User::where('id',$id)->first();
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
