<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:50',
            'line' => 'nullable|string|max:100',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($req->only(['name', 'email', 'phone', 'line', 'subject', 'message']));

        return redirect()->back()->with('message', "您的留言已送出，我將盡快與您聯繫 😊");
    }
}
