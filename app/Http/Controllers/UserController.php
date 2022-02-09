<?php

namespace App\Http\Controllers;

use App\GeneralSettings;
use App\Models\User;
use App\Http\Services\User\{
    IndexUserService,
    ShowUserService,
    CreateUserService,
    StoreUserService,
    EditUserService,
    UpdateUserService,
    DestroyUserService    
};
use App\Http\Requests\User\{
    StoreUserRequest,
    UpdateUserRequest
};
use Illuminate\Http\{
    Request,
    RedirectResponse
};
use Inertia\{
    Inertia,
    Response
};

class UserController extends Controller
{
    public function index(Request $request, GeneralSettings $settings): Response
    {
        return IndexUserService::execute($request, $settings);
    }
    
    public function show(User $user): Response
    {
        return ShowUserService::execute($user); 
    }   
   
    public function create(): Response
    {
        return CreateUserService::execute(); 
    }
    
    public function store(StoreUserRequest $request): RedirectResponse
    {
        return StoreUserService::execute($request);
    }
    
    public function edit(User $user): Response
    {
        return EditUserService::execute($user); 
    }
    
    public function update(User $user, UpdateUserRequest $request): RedirectResponse
    {
        return UpdateUserService::execute($user, $request);
    }
    
    public function destroy(User $user): RedirectResponse
    {
        return DestroyUserService::execute($user);
    }

}
