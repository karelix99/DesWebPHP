<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\User;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {

                $validatedData = $request->validate([
                    'user_name' => 'required|string|max:255',
                    'dob' => 'required|date',
                    'email' => 'required|string|email|max:255|unique:users,email',
                    'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
                ]);

                $user = new User([
                    'user_name' => $validatedData['user_name'],
                    'dob' => $validatedData['dob'],
                    'email' => $validatedData['email']
                ]);

                if ($request->hasFile('profile_pic')) {
                    $profilePic = $request->file('profile_pic');
                    if ($profilePic->getError()) {
                        return redirect()->back()->withInput()->withErrors(['profile_pic' => $profilePic->getError()]);
                    }
                    $filename = time() . '_' . $profilePic->getClientOriginalName();
                    $profilePic->storeAs('public/profile_pics', $filename);
                    $user->profile_pic = 'profile_pics/' . $filename;
                }

                $user->save();

                return redirect()->route('users.index')->with('success', 'User created successfully.');
        
        } catch (\Throwable $th) {
             return redirect()->route('user.index')->with('error', 'No se registró el usuario, verifique los datos.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // try {
            $validatedData = $request->validate([
                'user_name' => 'required|string|max:255',
                'dob' => 'required|date',
                'email' => 'required|string|email|max:255|unique:users,email,'.$id,
                'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        
            $user = User::find($id);
        
            $user->user_name = $validatedData['user_name'];
            $user->dob = $validatedData['dob'];
            $user->email = $validatedData['email'];

            if ($request->hasFile('profile_pic')) {
                $profilePic = $request->file('profile_pic');
                $filename = time() . '_' . $profilePic->getClientOriginalName();
                $profilePic->storeAs('public/profile_pics', $filename);
                $user->profile_pic = $filename;
            }
        
            $user->save();
    
            return redirect()->route('users.index')->with('update', 'Se editó correctamente');
    
        // } catch (\Throwable $th) {
        //     return redirect()->route('users.index')->with('error', 'No se editó el usuario, verifique los datos.');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $filename = $user->profile_pic;

        if ($filename != 'User_icon.png') {
            if ($filename && Storage::exists('public/profile_pics/' . $filename)) {
                Storage::delete('public/profile_pics/' . $filename);
            }
        }

        $user->delete();

        return redirect()->route('users.index')->with('delete', 'ok');
    }
}
