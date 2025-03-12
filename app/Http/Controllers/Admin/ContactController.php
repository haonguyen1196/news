<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Language;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:contact index'])->only('index');
        $this->middleware(['permission:contact update'])->only(['store']);
    }
    public function index()
    {
        $langs = Language::all();
        return view('admin.contact-page.index', compact('langs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|max:500',
            'phone' => 'required|max:255',
            'email' => 'required|email',
        ]);

        Contact::updateOrCreate(['lang' => $request->lang],[
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        toast(__('admin.Updated Successfully'),'success')->width(350);

        return redirect()->route('admin.contact.index');
    }
}
