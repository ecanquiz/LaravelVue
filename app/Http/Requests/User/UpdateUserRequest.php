<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role->name === "admin";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {    
        return [
            "name" => ["required", "max:255"],
            "email" => [
                "required", "max:255", "email",
                Rule::unique("users")->ignore( $this->route()->parameters()["user"]->id ),
            ],
            "password" => ["nullable"],
            "role_id" => ["required"],
        ];
    }
}
