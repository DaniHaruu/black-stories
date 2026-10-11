<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $name = 'Daniëlle';
        $email = '1123843@hr.nl';
        $message = 'Mocht u een vraag hebben, neem dan contact met mij op';

        return view('contact', [
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);
    }
}
