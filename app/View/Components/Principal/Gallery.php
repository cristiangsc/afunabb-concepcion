<?php

namespace App\View\Components\Principal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Gallery extends Component
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
        $galleries = Media::all()->sortByDesc('id')->where('collection_name', 'galleries')->take(12);

        return view('components.principal.gallery',compact('galleries'));
    }
}
