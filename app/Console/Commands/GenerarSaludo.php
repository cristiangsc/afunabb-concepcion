<?php

namespace App\Console\Commands;

use App\Jobs\SendSaludo;
use Illuminate\Console\Command;
use App\Models\Birthday;
use Illuminate\Support\Facades\DB;

class GenerarSaludo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:saludo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Saludo de cumpleaños socios';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users=DB::select('call cumpleanios()');
        foreach ($users as $key => $user) {
            $cumpleanios = Birthday::all()->random();
            $SaludoUsuario = [
                'nombre' => $user->nombres,
                'email'  => $user->email,
                'imagen' => $cumpleanios->getFirstMediaUrl('saludos'),
                'saludo' => $cumpleanios->mensaje
            ];
            SendSaludo::dispatch($SaludoUsuario,$user->email)->onQueue("saludo");
        }
    }
}
