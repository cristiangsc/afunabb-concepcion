<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\View\View;

class DashboardController extends Controller
{
   public function render():view
   {
       $slides = Slide::latest()->get();
       return view('dashboard',compact('slides'));
   }
}
