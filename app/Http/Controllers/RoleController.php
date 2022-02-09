<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\GeneralSettings;
use App\Models\Role;
use App\Http\Services\Role\{
    IndexRoleService,
    ShowRoleService,
    CreateRoleService,
    StoreRoleService,
    EditRoleService,
    UpdateRoleService,
    DestroyRoleService    
};
use Illuminate\Http\{
    Request,
    RedirectResponse
};

class RoleController extends Controller
{

    public function index(Request $request, GeneralSettings $settings): Response
    {
        return IndexRoleService::execute($request, $settings);
    }

    public function show(Role $role): Response
    {
        return ShowRoleService::execute($role); 
    }   

    public function create(): Response
    {
        return CreateRoleService::execute(); 
    }    

    public function store(Request $request): RedirectResponse
    {
        return StoreRoleService::execute($request);
    }

    public function edit(Role $role): Response
    {
        return EditRoleService::execute($role); 
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        return UpdateRoleService::execute($request, $role);
    }

    public function destroy(Request $request): RedirectResponse
    {
        return DestroyRoleService::execute($request);
    }

}
