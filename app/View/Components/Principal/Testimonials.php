<?php

namespace App\View\Components\Principal;

use App\Models\Testimony;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Testimonials extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $testimonials = Testimony::with('user')->latest()->get();       //->latest()->take(3)->get();

       $testimonials = $testimonials->unique('user_id')->take(3);

        return view('components.principal.testimonials', compact('testimonials'));
    }
}
