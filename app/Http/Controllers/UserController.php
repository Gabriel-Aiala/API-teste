<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    public function __construct(UserRepository $userRepository) 
    {
        $this->userRepository = $userRepository;
    }

    public function store(UserStoreRequest $request)
    {
       $user = $this->userRepository->createUser($request);
        
        return response()->json($user, 201);
    }

    public function listAll()
    {
        $users = $this->userRepository->buscarTodosUsuarios();
        if($users)
        {
            return response()->json($users->toJson(), 200);
        }else
        {
            return response()->json('nenhum usuario foi encontrado',404);
        }
    }
    public function list($id)
    {
        
        $user = $this->userRepository->buscarUsuario($id);
        if ($user) {
            return response()->json($user->toJson(), 200);
        }else{
            return response()->json('nenhum usuario foi encontrado',404);
        }
        
    }
    public function update(Request $request , $id)
    {
        $user = $this->userRepository->buscarUsuario($id);
        if ($user)
        {
            $user->fill($request->all());
            $user->save();
            return response()->json($user->toJson(), 200);
        }else
        {
            return response()->json('nenhum usuario foi encontrado', 404);
        }
    }
    public function destroy($id)
    {
        $user = $this->userRepository->buscarUsuario($id);
        if ($user)
        {
            $user->delete();
            return response()->noContent();
        }else
        {
            return response()->json('nenhum usuario foi encontrado', 404);
        }
    }
    
    

    
    
}

