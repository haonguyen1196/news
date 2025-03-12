<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRoleUserStoreRequest;
use App\Http\Requests\AdminRoleUserUpdateRequest;
use App\Mail\UserCreateMail;
use App\Models\Admin;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller
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
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $admins = Admin::orderBy('id', 'desc')->get();
        return view('admin.role-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('id', 'desc')->get();
        return view('admin.role-user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRoleUserStoreRequest $request)
    {
        try{
            $user = Admin::create([
                'image' => '',
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            //assign role for user
            $user->assignRole($request->role);

            toast(__('admin.Created Successfully'),'success')->width(350);

            //send mail
            Mail::to($request->email)->send(new UserCreateMail($request->email, $request->password));

            return redirect()->route('admin.role-user.index');
        }catch(Exception $e) {
            // Hiển thị thông báo lỗi chi tiết bằng toast
            toast(__('admin.An error occurred: ' . $e->getMessage()), 'error')->width(350);

            // Chuyển hướng người dùng trở lại trang trước đó
            return redirect()->back()->withInput();
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::orderBy('id', 'desc')->get();
        return view('admin.role-user.edit', compact('roles', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRoleUserUpdateRequest $request, string $id)
    {
        try{
            $user = Admin::findOrFail($id);

            $user->update([
                'image' => '',
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if($request->filled('password')){
                $request->validate([
                    'password' => 'confirmed|min:8'
                ]);

                // Cập nhật mật khẩu mới
                $user->update([ 'password' => bcrypt($request->password), ]);
            }

            //assign role for user
            $user->syncRoles($request->role);

            toast(__('admin.Update Successfully'),'success')->width(350);

            return redirect()->route('admin.role-user.index');
        }catch(Exception $e) {
            // Hiển thị thông báo lỗi chi tiết bằng toast
            toast(__('admin.An error occurred: ' . $e->getMessage()), 'error')->width(350);

            // Chuyển hướng người dùng trở lại trang trước đó
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $admin = Admin::findOrFail($id);
            $admin->delete();

            if($admin->getRoleNames()->first() != 'Super Admin'){
            return response()->json(['status' => 'error','message'=> __('admin.Can\'t delete this super admin')]);

            }

            return response()->json(['status' => 'success','message'=> __('admin.Deleted success!')]);
        }catch (\Exception $e){
            return response()->json(['status' => 'error','message'=> __('admin.Something went wrong!')]);
        }
    }
}
