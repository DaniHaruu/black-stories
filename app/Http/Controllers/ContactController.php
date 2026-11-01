<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $name = 'Daniëlle Ruwaard';
        $email = '1123843@hr.nl';
        $message = 'Feel free to contact me if you have a question.';

        return view('contact', [
            'name' => $name,
            'email' => $email,
            'message' => $message
        ]);
    }
}
