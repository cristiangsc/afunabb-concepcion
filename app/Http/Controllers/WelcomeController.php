<?php

namespace App\Http\Controllers;

use App\DataTransferObjects\Contact;
use App\Mail\ContactMail;
use App\Models\Antecedente;
use App\Models\Slide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class WelcomeController extends Controller
{

    public function about(): view
    {
        $about = Antecedente::all()->first();

        return view('about-welcome', compact('about'));
    }


    public function render(): view
    {
        $slides = Slide::all();
        return view('welcome', compact('slides'));
    }

    final public function send(): RedirectResponse
    {
        return rescue(
            callback: function ()
            {
                $contact = Contact::fromRequest();
                $admin = 'administrador@cscdeveloper.com';
                Mail::to($admin)->send(new ContactMail($contact));
                Alert::success('¡Éxito!', 'El correo ha sido enviado correctamente');

                return redirect()->back()->with('success', 'El correo ha sido enviado correctamente');
            },
            rescue: function ($e)
            {
                Alert::warning('¡ERROR!', 'Debe corregir los errores del formulario, los campos son obligatorios');
                return redirect()->back()->with('error',$e->getMessage());
            }, report: true,

        );
    }
}
