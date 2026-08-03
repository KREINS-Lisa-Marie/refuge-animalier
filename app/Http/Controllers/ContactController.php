<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public $successMessage;

    public function index()
    {
        return view('public.contact', [
            'title' =>__('general.contact'),
            'successMessage'=>'' ]);
    }

    public function store(Request $request, String $locale)
    {
        $request->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'string|required|max:255',
            'subject'=>'string|required',
            'message'=>'string|required',
            'email'=>'email|required',
        ]);

        Message::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'subject' => $request->subject,
            'message' => $request->message,
            'state' => 'not_read_yet',
            'email' => $request->email,
        ]);

        $successMessage = __('public/contact.form_sent');

        return redirect(route('public.contact', ['locale' => $locale]) . '#request')->with(
            'successMessage', $successMessage);
    }

}
