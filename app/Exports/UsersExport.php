<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{

       public function view(): View
    {
        return view('exports.usersExport', [ 'users' => User::with('sede','banco','reparticion','cargo','cuenta')->withTrashed()->get()]);
    }

}
