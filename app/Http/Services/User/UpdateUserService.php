<?php
namespace App\Http\Services\User;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;

class UpdateUserService
{

    static public function execute(User $user, UpdateUserRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        
        if ($data["password"])
            $data["password"] = Hash::make($data["password"]);
        else
            unset($data["password"]);        

        $user->update($data);

        return redirect()
            ->route("users")
            ->with("success", "Usuario actualizado.");       

  }

}
