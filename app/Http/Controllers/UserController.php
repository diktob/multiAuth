<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ListUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listUser = ListUser::all();
        return view('users.index', compact('listUser'));
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
        //ListUser::create($request->all());
        //return redirect()->route('admin/user')->with('success', 'User added successfully');
        User::create([
            'id'=>$request->id,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'type'=>$request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        (new UserController)->sync();
        return redirect()->route('admin/user')->with('success', 'User added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $listUser = ListUser::findOrFail($id);
        return view('users.show', compact('listUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listUser = User::findOrFail($id);
        return view('users.edit', compact('listUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fillable = ['name', 'email', 'password', 'role'];
        $listUser = User::findOrFail($id);
        $listUser->update($request->only($fillable));
        (new UserController)->sync();
        return redirect()->route('admin/user')->with('success', 'User Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $listUser = User::findOrFail($id);
        $listUser -> delete();
        (new UserController)->sync();
        return redirect()->route('admin/user')->with('success', 'User deleted successfully');

    }

    public function sync(){
    // Dapatkan semua user
    $users = User::all();

    // Hapus semua data lama di list_user
    ListUser::truncate();

    // Buat data baru di list_user untuk setiap user
    foreach ($users as $user) {
        $role = $user->type; 
        switch ($user->type) {
            case '1':
                $role = 'admin';
                break;
            case '2':
                $role = 'manager';
                break;
            case '3':
                $role = 'supervisor';
                break;
            }

            ListUser::create([
                'name' => $user->name,
                'email' => $user->email,
                'role' => $role,
            ]);
        }


}

}
