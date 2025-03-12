<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\FlareClient\Http\Response as HttpResponse;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:access manager index'])->only('index');
        $this->middleware(['permission:access manager create'])->only(['create', 'store']);
        $this->middleware(['permission:access manager update'])->only(['edit', 'update']);
        $this->middleware(['permission:access manager delete'])->only('destroy');
    }
    public function index(): View
    {
        $roles = Role::orderBy('id', 'desc')->get();
        return view('admin.role.index', compact('roles'));
    }

    public function create(): View
    {
        //php artisan permission:create-permission "category index" admin (tạo permission)
        $permissions = Permission::all()->groupBy('group_name');
        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'role' => 'required|max:50|unique:permissions,name',
        ]);

        //create role
        $role = Role::create(['name' => $request->role, 'guard_name' => 'admin']);

        //assign permission to the role
        $role->syncPermissions($request->permission);

        toast(__('admin.Saved Successfully'),'success')->width(350);

        return redirect()->route('admin.role.index');
    }

    public function edit($id): View
    {
        $permissions = Permission::all()->groupBy('group_name');
        $role = Role::findOrFail($id);
        $rolePermissions = $role->permissions;
        $rolePermission = $rolePermissions->pluck('name')->toArray();

        return view('admin.role.edit', compact('permissions', 'role', 'rolePermission'));
    }

    public function update(Request $request, $id):RedirectResponse
    {
        $request->validate([
            'role' => 'required|max:50|unique:permissions,name',
        ]);

        //update role
        $role = Role::findOrFail($id);
        $role->update(['name' => $request->role, 'guard_name' => 'admin']);

        //assign permission to the role
        $role->syncPermissions($request->permission);

        toast(__('admin.Saved Successfully'),'success')->width(350);

        return redirect()->route('admin.role.index');
    }

    public function destroy($id): JsonResponse
    {
        try{
            $role = Role::findOrFail($id);
            if($role->name == 'Super Admin'){
                return response()->json(['status' => 'error','message'=> __('admin.Can\'t delete Super Admin')]);
            }
            $role->delete();

            return response()->json(['status' => 'success','message'=> __('admin.Deleted success!')]);
        }catch (\Exception $e){
            return response()->json(['status' => 'error','message'=> __('admin.Something went wrong!')]);
        }
    }
}
