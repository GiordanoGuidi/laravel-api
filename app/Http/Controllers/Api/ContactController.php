<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function message(Request $request)
    {
        //Prendo tutti i dati passati nella request
        $data = $request->all();

        $validator = Validator::make(
            $data,
            [
                'email' => 'required|email',
                'subject' => 'required|string',
                'message' => 'required|string',
            ],
            //Messaggi di errore personalizzati
            [
                'email.required' => 'Il campo email è obbligatorio',
                'email.email' => 'La mail non è valida',
                'subject.required' => 'L\'oggetto della mail è obbligatorio',
                'message.required' => 'Il messaggio della mail è obbligatorio',
            ]
        );

        /*Facciamo restituire al validatore soltannto il primo
        messaggio di errore per ogni campo sbagliato*/
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->messages() as $field => $messages) {
                $errors[$field] = $messages[0];
            }
            return response()->json(compact('errors'), 422);
        }
        //Istanziamo ContactMessageMail
        $mail = new ContactMessageMail(
            subject: $data['subject'],
            sender: $data['email'],
            content: $data['message'],
        );
        Mail::to(env('MAIL_TO_ADDRESS'))->send($mail);
        //Tutto ok no content
        return response(null, 204);
    }
}
