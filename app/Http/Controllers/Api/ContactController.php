<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function message(Request $request)
    {
        //Prendo tutti i data passati nella request
        $data = $request->all();

        $mail = new ContactMessageMail(
            subject: $data['subject'],
            sender: $data['sender'],
            content: $data['content'],
        );
        Mail::to(env('MAIL_TO_ADDRESS'))->send($mail);
        //Tutto ok no content
        return response(null, 204);
    }
}
