<?php
namespace App\Http\Services\User;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\User;

class DestroyUserService
{

    static public function execute(User $user): \Illuminate\Http\RedirectResponse
    { 

        $user->delete();

        return redirect()
            ->route("users")
            ->with("success", "Usuario eliminado.");

    }

}


