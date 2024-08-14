<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    function index(){
        $users = User::with('roles:name')->get();

        return view('users.index', compact('users'));
    }

    function show($id){
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    function edit($id){
        $user = User::find($id);
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    function update(UpdateUserRequest $request, $id){
        $user = User::find($id);

        // eğer parola null ise
        if($request->password == null)
            $data = $request->except('password');
        else {
            $data = $request->validated();
            $data['password'] = Hash::make($request->password);

            // eğer kullanıcı kendisini düzenliyorsa ve şifresini değiştirmişse çıkış yap
            if(auth()->user()->id == $user->id)
                auth()->logout();    
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect()->route('user.list');
    }

    function create(){
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    function store(CreateUserRequest $request){
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);
        $user->assignRole($request->roles);

        return redirect()->route('user.list');
    }

    function destroy(User $user){

        // kullanıcı eğer admin ise hata ver
        if($user->hasRole('admin'))
            return back()->withErrors(['error' => 'Admin kullanıcı silinemez!']);

        $user->delete();

        return redirect()->route('user.list');
    }

}
