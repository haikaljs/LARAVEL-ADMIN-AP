<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;

class RoleController extends Controller
{
  
    public function index()
    {
        return RoleResource::collection(Role::all());
    }

  
    public function store(Request $request)
    {
        $role = Role::create($request->only('name'));

        return response(new RoleResource($role), Response::HTTP_CREATED); // 201
    }

  
    public function show(string $id)
    {
        return new RoleResource(Role::find($id));
    }

 
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);

        $role->updatea($request->only('name'));

        return response(new RoleResource($role), Response::HTTP_CREATED); // 202
    }

   
    public function destroy(string $id)
    {
        Role::destroy($id);

        return response(null, Response::HTTP_NO_CONTENT); //204
    }
}
