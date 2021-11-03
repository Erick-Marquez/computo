<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Permission as ContractsPermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();
        return RoleResource::collection($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);

        return response()->json(['message' => 'Rol Creado']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = $role->getAllPermissions()->makeHidden('pivot');

        $rolePermissions = [];

        foreach ($permissions as $permission) {
            array_push($rolePermissions, $permission['id']);
        }

        $allPermissions = Permission::all();

        return response()->json([
            'allPermissions' => $allPermissions,
            'rolePermissions' => $rolePermissions,
            'role' => $role->makeHidden('permissions')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->all())->forgetCachedPermissions();
        return response()->json(['message' => 'Permisos actualizados']);

    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Rol Eliminado']);
    }
}
