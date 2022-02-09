<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MyProfileController extends Controller
{
    public function edit(User $user)
    {
        return Inertia::render("MyProfile/Edit");
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            "name" => ["required", "max:255"],
            "email" => [
                "required",
                "max:255",
                "email",
                Rule::unique("users")->ignore($user->id),
            ],
        ]);

        $user->update($data);

        return redirect()
            ->route("myprofile.edit")
            ->with("success", "Perfil actualizado.");
    }

    public function updatePassword(Request $request)
    {
        // validate
        $user = $request->user();
        $data = $request->validate([
            "password" => ["required", "confirmed"],
            "password_confirmation" => ["required"],
            "current_password" => [
                "required",
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__("La contraseña actual es incorrecta."));
                    }
                },
            ],
        ]);

        // save
        $user->password = Hash::make($data["password"]);
        $user->setRememberToken(Str::random(60));
        $user->save();

        return redirect()
            ->route("myprofile.edit")
            ->with("success", "Contraseña actualizada.");
    }
}
