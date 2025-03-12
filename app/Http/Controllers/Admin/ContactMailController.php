<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Models\RecivedMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMailController extends Controller
{
    public function __construct()
    {
        // Sử dụng middleware 'auth:admin' trước
        $this->middleware('auth:admin');

        $this->middleware(['permission:contact email index'])->only('index');
    }
    public function index()
    {
        $mailContacts = RecivedMail::orderBy("id", 'desc')->get();
        return view('admin.contact-mail.index', compact('mailContacts'));
    }

    public function replyMail(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        try{
            $mailContact = RecivedMail::findOrFail($request->contact_mail_id);
            $mailContact->update(['reply' => 1]);
            $contact = Contact::where('lang', 'en')->first();
            Mail::to($request->email)->send(new ContactMail($request->subject, $request->message, $contact->email));

            toast(__('admin.Mail send successfully'),'success')->width(350);

            return redirect()->back();
        }catch(Exception $e){
            toast(__($e->getMessage()),'error')->width(350);

            return redirect()->back();
        }
    }
}
