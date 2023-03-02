<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    public function createUser($request)
    {
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
         
    }

    public function buscarUsuario($id)
    {
        
       return User::find($id);
    }
    
    public function buscarTodosUsuarios()
    {
       return User::all();
    }
}