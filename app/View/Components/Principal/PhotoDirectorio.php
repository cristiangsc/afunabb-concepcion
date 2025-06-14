<?php

namespace App\View\Components\Principal;

use App\Models\Directorio;
use App\Models\PhotoDirectiva;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PhotoDirectorio extends Component
{
     public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        $photo = PhotoDirectiva::latest()->first();

         return view('components.principal.photo-directorio',compact('photo'));
    }
}
