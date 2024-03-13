<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateInfoRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    public function index()
    {
        return User::paginate();
    }

    public function store(UserCreateRequest $request)
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email')  + ['password' => Hash::make('123')]
        );

        return response($user, Response::HTTP_CREATED); // 201
    }

    
    public function show(string $id)
    {
        return User::find($id);
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->only('first_name', 'last_name', 'email'));

        return response($user, RESPONSE::HTTP_ACCEPTED); // 202
    }

  
    public function destroy(string $id)
    {
        User::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT); //204
    }

    public function updateInfo(UpdateInfoRequest $request){

        $user = $request->user();
        $user->update($request->only('first_name', 'last_name', 'email'));

        return response($user, RESPONSE::HTTP_ACCEPTED); // 202
    }

    public function updatePassword(UpdatePasswordRequest $request){
        
        $user = $request->user();
        $user->update([
            'password' => Hash::make($request->input('password'))
        ]);

        return response($user, RESPONSE::HTTP_ACCEPTED); // 202
    }
}
