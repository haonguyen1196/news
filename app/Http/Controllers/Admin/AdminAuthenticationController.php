<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminResetPasswordRequest;
use App\Http\Requests\HandleLoginRequest;
use App\Http\Requests\SendResetLink;
use App\Mail\AdminSendResetLinkMail;
use App\Models\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminAuthenticationController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function handleLogin(HandleLoginRequest $request)
    {
        $request->authenticate();

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request):RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function forgotPassword():View
    {
        return view('admin.auth.forgot-password');
    }

    public function sendLinkReset(SendResetLink $request)
    {
        $token = Str::random(64);

        $admin = Admin::where('email', $request->email)->first();

        $admin->remember_token = $token;
        $admin->save();

        //send email with token
        Mail::to($request->email)->send(new AdminSendResetLinkMail($token, $request->email));

        return redirect()->back()->with('success', __('admin.Reset link sent to your email'));
    }

    public function resetPassword($token): View
    {
        return view('admin.auth.reset-password', compact('token'));
    }

    public function handleResetPassword(AdminResetPasswordRequest $request)
    {
        $admin = Admin::where([ ['email', '=', $request->email], ['remember_token', '=', $request->token] ])->first();

        if($admin){
            $admin->password = bcrypt($request->password);
            $admin->remember_token = null;
            $admin->save();
        } else{
            return redirect()->back()->with('error','Invalid token');
        }

        return redirect()->route('admin.login')->with('success', __('admin.Password reset successfully'));
    }
}
