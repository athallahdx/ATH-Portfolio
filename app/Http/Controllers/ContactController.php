<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Response;


class ContactController extends Controller
{
    public function index(): Response
    {
        $contact = Contact::first();

        return inertia('Contact', [
            'contact' => $contact,
        ]);
    }
}
