<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Http\Requests\AdminUpdatePasswordRequest;
use App\Models\Admin;
use App\Traits\FileUpdateTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUpdateTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard("admin")->user();
        return view("admin.profile.index", compact("user"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProfileUpdateRequest $request, string $id)
    {
        $filePath = $this->handleFileUpdate($request, 'image', $request->old_image);

        $admin = Admin::findOrFail($id);
        $admin->update([
            'image' => !empty($filePath) ? $filePath : $request->old_image,
            'name' => $request->name,
            'email' => $request->email
        ]);

        toast(__('admin.Updated Successfully'),'success')->width(400);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function profilePassword(AdminUpdatePasswordRequest $request, string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->update([
            'password' => bcrypt($request->password),
        ]);

        toast(__('admin.Updated Successfully'),'success')->width(400);

        return redirect()->back();
    }
}
