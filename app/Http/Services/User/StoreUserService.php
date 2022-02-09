<?php
namespace App\Http\Services\User;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreUserRequest;
use App\Models\User;

class StoreUserService
{
  
    static public function execute(StoreUserRequest $request): \Illuminate\Http\RedirectResponse
    {        
        $request["password"] = Hash::make($request["password"]);

        User::create([
            "name" => $request["name"],
            "email" => $request["email"],
            "password" => $request["password"],
            "role_id" => $request["role_id"],
        ]);

        return redirect()
            ->route("users")
            ->with("success", "Usuario creado.");        

    }

}
